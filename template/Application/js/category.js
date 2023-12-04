
loadall()
btnAction = 'Insert'; 

$("#addNew").on("click", (event)=>{
   $("#categoryModal").modal("show");
});

$("#categoryForm").on("submit", (event)=>{
    event.preventDefault();


    let name= $("#name").val();
    let icon= $("#icon").val();
    let role= $("#role").val();
    let id= $("#update_id").val();



    let sendingdata= {

    }
    if(btnAction== 'Insert'){
        sendingdata= {
            "name": name,
            "icon": icon,
            "role": role,
            "action": "register_category"
        }
    }else{
      
        sendingdata= {
            "id": id,
            "name": name,
            "icon": icon,
            "role": role,
            "action": "Update_category"
        }
    }
    
  
    $.ajax({
        method: "POST",
        datatype: "JSON",
        url: "../Api/category.php",
        data: sendingdata,
        success: function(data){
            let status= data.status;
            let response= data.data;
            if(status){
               dispalyMessage("success", response);
               btnAction= "Insert";
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
    let sendingdata= {
        "action": "get_all_category",
    }

    $.ajax({
        method: "POST",
        datatype: "JSON",
        url: "../Api/category.php",
        data: sendingdata,
        success: function(data){
            let status= data.status;
            let response= data.data;
            let html= '';
            let tr= '';

            if(status){
                response.forEach( res => {
                    tr+= "<tr>"
                    for(let i in res){
                        tr+= `<td>${res[i]}</td>`
                      }
                    tr+=`<td> <a class="btn btn-success Update_Info" update_id= ${res['id']}> <i class="fas fa-edit" style="color:#fff;"></i> </a>
                    <a class="btn btn-danger delete_Info" delete_id= ${res['id']}><i class="fas fa-trash"style="color:#fff;"></i></a>    </td>`
                    tr+= "</tr>"
                });
                $("#categoryTable").append(tr);
            }

        },error: function(data){

        }
    })
} 

function fetchUserInfo(id){
    let sendingdata= {
        "action": 'get_category_info',
        "id": id,
    }

    $.ajax({
        method: "POST",
        datatype: "JSON",
        url: "../Api/category.php",
        data: sendingdata,
        success: function(data){
            

            let status= data.status;
            let response= data.data;

            let html= '';
            let tr= '';

            if(status){

                btnAction= "Update";
                $("#update_id").val(response['id']);
                $("#name").val(response['name']);
                $("#icon").val(response['icon']);
                $("#role").val(response['role']);

                $("#categoryModal").modal("show");
            }else{
                dispalyMessage("error", response);
            }
        }, error: function(data){

        }
    })
}

function delete_category_info(id){
    let sendingdata= {
        "action": 'delete_category_info',
        "id": id,
       
    }
    $.ajax({
        method: "POST",
        datatype: "JSON",
        url: "../Api/category.php",
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

$("#categoryTable").on("click","a.Update_Info", function(){

    let id= $(this).attr("update_id");
    // alert(id)
    fetchUserInfo(id);
})

$("#categoryTable").on("click","a.delete_Info", function(){

    let id= $(this).attr("delete_id");
    delete_category_info(id);
   
    //   
})