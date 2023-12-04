loadall();
btnAction = 'Insert'; 
fill_links();
fill_categors();
$("#addNew").on("click", (event)=>{
   $("#linkModal").modal("show");
});

$("#linkForm").on("submit", (event)=>{
    event.preventDefault();


    let name= $("#name").val();
    let link_id= $("#link_id").val();
    let category= $("#category_id").val();
    let id= $("#update_id").val();



    let sendingdata= {

    }
    if(btnAction== 'Insert'){
        sendingdata= {
            "name": name,
            "link_id": link_id,
            "category": category,
            "action": "register_link"
        }
    }else{
      
        sendingdata= {
            "id": id,
            "name": name,
            "link_id": link_id,
            "category": category,
            "action": "Update_link"
        }
    }
    
  
    $.ajax({
        method: "POST",
        datatype: "JSON",
        url: "../Api/system_link.php",
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
        "action": "read_all_links",
    }

    $.ajax({
        method: "POST",
        datatype: "JSON",
        url: "../Api/system_link.php",
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
                $("#linkTable").append(tr);
            }

        },error: function(data){

        }
    })
} 

function fill_links(){
    let sendingdata= {
        "action": "read_all_link",
    }

    $.ajax({
        method: "POST",
        datatype: "JSON",
        url: "../Api/system_link.php",
        data: sendingdata,
        success: function(data){
            let status= data.status;
            let response= data.data;
            let html= '';
            let tr= '';

            if(status){
                response.forEach( res => {
                   html += `<option value="${res}">${res}</option>`;
                });

                $("#link_id").append(html);
              
            }

        },error: function(data){

        }
    })
} 

function fill_categors(){
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
                   html += `<option value="${res['id']}">${res['role']}</option>`;
                });

                $("#category_id").append(html);

              
            }

        },error: function(data){

        }
    })
} 

function fetchlinkinfo(id){
    let sendingdata= {
        "action": 'get_link_info',
        "id": id,
    }

    $.ajax({
        method: "POST",
        datatype: "JSON",
        url: "../Api/system_link.php",
        data: sendingdata,
        success: function(data){
            
            let status= data.status;
            let response= data.data;

            let html= '';
            let tr= '';

            if(status){

                btnAction= "Update";
                $("#update_id").val(response['id']);
                $("#name").val(response['Name']);
                $("#link_id").val(response['link']);
                $("#category_id").val(response['category_id']);

                $("#linkModal").modal("show");
            }else{
                dispalyMessage("error", response);
            }
        }, error: function(data){

        }
    })
}

function delete_link_info(id){
    let sendingdata= {
        "action": 'delete_link_info',
        "id": id,
       
    }
    $.ajax({
        method: "POST",
        datatype: "JSON",
        url: "../Api/system_link.php",
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

$("#linkTable").on("click","a.Update_Info", function(){

    let id= $(this).attr("update_id");
    fetchlinkinfo(id);
    // loadall(id);
})

$("#linkTable").on("click","a.delete_Info", function(){

    let id= $(this).attr("delete_id");
    delete_link_info(id);
   
    //   
})