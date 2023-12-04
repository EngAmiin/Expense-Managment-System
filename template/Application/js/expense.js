
loadall()
btnAction = 'Insert'; 

$("#addNew").on("click", (event)=>{
   $("#expenseModal").modal("show");
});

$("#expenseForm").on("submit", (event)=>{
    event.preventDefault();


    let amount= $("#amount").val();
    let type= $("#type").val();
    let description= $("#description").val();
    let id= $("#updated_expanseID").val();



    let sendingdata= {

    }
    if(btnAction== 'Insert'){
        sendingdata= {
            "amount": amount,
            "type": type,
            "decription": description,
            "action": "register_expense"
        }
    }else{
      
        sendingdata= {
            "id": id,
            "amount": amount,
            "type": type,
            "decription": description,
            "action": "Update_expense"
        }
    }
    
  
    $.ajax({
        method: "POST",
        datatype: "JSON",
        url: "../Api/expense.php",
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
        "action": "get_alltransaction",
    }

    $.ajax({
        method: "POST",
        datatype: "JSON",
        url: "../Api/expense.php",
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
                      if(i== "type"){
                        if(res[i] == 'Income'){
                            tr+= `<td><span class="badge mt-3 badge-success">${res[i]}</span></td>`
                        }else{
                            tr+= `<td><span class="badge mt-3 badge-danger">${res[i]}</span></td>`
                        }
                      }else{
                        tr+= `<td>${res[i]}</td>`
                      }
                    } 
                    tr+=`<td> <a class="btn btn-success Update_Info" update_id= ${res['id']}> <i class="fas fa-edit" style="color:#fff;"></i> </a>
                    <a class="btn btn-danger delete_Info" delete_id= ${res['id']}><i class="fas fa-trash"style="color:#fff;"></i></a>    </td>`
                    tr+= "</tr>"
                });
                $("#expTable").append(tr);
            }

        },error: function(data){

        }
    })
} 



function fetchUserInfo(id){
    let sendingdata= {
        "action": 'get_expense_info',
        "id": id,
    }

    $.ajax({
        method: "POST",
        datatype: "JSON",
        url: "../Api/expense.php",
        data: sendingdata,
        success: function(data){
            

            let status= data.status;
            let response= data.data;

            let html= '';
            let tr= '';

            if(status){

                btnAction= "Update";
                $("#updated_expanseID").val(response['id']);
                $("#amount").val(response['amount']);
                $("#type").val(response['type']);
                $("#description").val(response['description']);

                $("#expenseModal").modal("show");
            }else{
                dispalyMessage("error", response);
            }
        }, error: function(data){

        }
    })
}

function delete_expense_info(id){
    let sendingdata= {
        "action": 'delete_expense_info',
        "id": id,
       
    }
    $.ajax({
        method: "POST",
        datatype: "JSON",
        url: "../Api/expense.php",
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

$("#expTable").on("click","a.Update_Info", function(){

    let id= $(this).attr("update_id");
    // alert(id)
    fetchUserInfo(id);
})

$("#expTable").on("click","a.delete_Info", function(){

    let id= $(this).attr("delete_id");
    delete_expense_info(id);
   
    //   
})