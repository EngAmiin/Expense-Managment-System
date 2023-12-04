
loadall()

btnAction = 'Insert'; 


let fileimage= document.querySelector("#image");
let showimage= document.querySelector("#show");
const reader = new FileReader();
fileimage.addEventListener('change', function(e){
    const selectedfile= e.target.files[0];
    reader.readAsDataURL(selectedfile);
})

reader.onload= e=>{
    showimage.src = e.target.result;
}



$("#addNew").on("click", (event)=>{
   $("#userModal").modal('show');
});

$("#userForm").on("submit", (event)=>{
    event.preventDefault();


    // let amount= $("#amount").val();
    // let type= $("#type").val();
    // let description= $("#description").val();
    // let id= $("#updated_expanseID").val();



    let form_data= new FormData($("#userForm")[0]);
    form_data.append("image",$("input[type=file]")[0].files[0]);

    let sendingdata= {

    }
    if(btnAction== 'Insert'){
       form_data.append("action", "register_user");
    }else{
        form_data.append("action", "update_user");
    }
    
  
    $.ajax({
        method: "POST",
        datatype: "JSON",
        url: "../Api/users.php",
        data: form_data,
        processData: false,
        contentType: false,
        success: function(data){
            let status= data.status;
            let response= data.data;
            
            if(status){
               dispalyMessage("success", response);
               btnAction= "Insert";
               $("#userForm")[0].reset();
               loadall();
            }else{
              dispalyMessage("error", response);
            }
        },error: function(data){

        }
    })
});

function dispalyMessage(type, message){
    let success= document.querySelector(".alert-success");
    let error= document.querySelector(".alert-danger");
    if(type== 'success'){
       error.classList= "alert alert-danger d-none";
       success.classList= "alert alert-success";
       success.innerHTML= message;


       setTimeout(function(){
        $("#expenseModal").modal("hide");
        $("#expenseForm")[0].reset();
        success.classList= "alert alert-success d-none";
       },3000)
    }else{
        error.classList="alert alert-danger";
        setTimeout(function(){
        $("#expenseModal").modal("hide");
        $("#expenseForm")[0].reset();
        error.classList= "alert alert-success d-none";
        },3000)
        error.innerHTML= message;
    }
}


function loadall(){
    $("#userTable tr").html('');
    let sendingdata= {
        "action": "loadall",
    }

    $.ajax({
        method: "POST",
        datatype: "JSON",
        url: "../Api/users.php",
        data: sendingdata,
        success: function(data){
            let status= data.status;
            let response= data.data;
            let html= '';
            let tr= '';
            let th= '';
            if(status){
                response.forEach( res => {

                    th = "<tr>"
                    for(let r in res){
                        th += `<th>${r}</th>`;
                    }
                    th+= "<th>Action</th> </tr>";


                    tr+= "<tr>";
                    for(let i in res){
                      if(i== "Image"){
                      
                            tr+= `<td><img style="width:70px; border:1px; height:70px; border-radius:50%; object-fit:cover;" src="../uploads/${res[i]}"></span></td>`
                      }else{
                        tr+= `<td>${res[i]}</td>`
                      }
                    } 
                    tr+=`<td> <a class="btn btn-success Update_Info" update_id= ${res['id']}> <i class="fas fa-edit" style="color:#fff;"></i> </a>
                    <a class="btn btn-danger delete_Info" delete_id= ${res['id']}><i class="fas fa-trash"style="color:#fff;"></i></a>    </td>`
                    tr+= "</th>"
                });
                $("#userTable thead").append(th);
                $("#userTable tbody").append(tr);
            }

        },error: function(data){

        }
    })
} 


function fetchUserInfo(id){
    let sendingdata= {
        "action": 'get_user_info',
        "id": id,
    }

    $.ajax({
        method: "POST",
        datatype: "JSON",
        url: "../Api/users.php",
        data: sendingdata,
        success: function(data){

            let status= data.status;
            let response= data.data;

            let html= '';
            let tr= '';

            if(status){
                btnAction= "Update";
                $("#update_useriD").val(response['id']);
                $("#Username").val(response['Username']);
                // $("#password").val(response['Password']);
                $("#show").attr('src', `../uploads/${response['Image']}`);
                $("#userModal").modal('show');
            }else{
                dispalyMessage("error", response);
            }
        }, error: function(data){

        }
    })
}

function delete_expense_info(id){
    let sendingdata= {
        "action": 'delete_user_info',
        "id": id,
       
    }
    $.ajax({
        method: "POST",
        datatype: "JSON",
        url: "../Api/users.php",
        data: sendingdata,
        success: function(data){

            let status= data.status;
            let response= data.data;

            let html= '';
            let tr= '';

            if(status){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Are You want To Delete This Data!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                  }).then((result) => {
                    if (result.isConfirmed) {
                      Swal.fire(
                        'Deleted!', 'Your Data Has Been Deleted.', 'success', response[0] )}}) 
            }
        }, error: function(data){
        }
    })
}

$("#userTable").on("click","a.Update_Info", function(){

    let id= $(this).attr("update_id");
 
    fetchUserInfo(id);
})

$("#userTable").on("click","a.delete_Info", function(){

    let id= $(this).attr("delete_id");
    delete_expense_info(id);
   
    //   
}) 