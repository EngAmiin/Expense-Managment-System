
$("#from").attr('disabled', true);
$("#to").attr('disabled', true);

$("#type").on('change', function(){
    if($("#type").val() == 0){
        $("#from").attr('disabled', true);
        $("#to").attr('disabled', true);
    }else{
        $("#from").attr('disabled', false);
        $("#to").attr('disabled', false);
    }
});


$("#print_statement").on("click", function(){
    print_statement();
})

function print_statement(){

    let print_area= document.querySelector("#print_area");

    let newwindow= window.open("");
    newwindow.document.write(`<html><head><tittle></tittle>`);
    newwindow.document.write(`<style media="print">
    
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital@1&family=Roboto&display=swap');


    body{
        font-family: 'Poppins', sans-serif;
    }

    th{
        background-color: green !important;
        color: white !important;
    }
    th, td{
        padding: 5px !important;
        text-align: left !important;
    }

    th,td{
        border-bottom: 1px solid #dddd !important;
    }

    table{
        width: 100%;
    }

    </style>`)

    newwindow.document.write(`</head><body>`);
    // newwindow.document.write('<img width="80%;" height=400px" src="../views/just.jpg">')
    newwindow.document.write(print_area.innerHTML);

    newwindow.document.write(`</body></html>`);
    newwindow.print();
    newwindow.close();
}


$("#export_statement").on("click", function(){
    let file= new Blob([$('#print_area').html()], {type: "application/vnd.ms-excel"});
    let url= URL.createObjectURL(file);
    let a= $("<a/>",{
        href: url,
        download: "print_statement.xls"}).appendTo("body").get(0).click();
        e.preventDefault(); 
    });







$("#userform").on("submit", (event)=>{
    event.preventDefault();

    let from= $("#from").val();
    let to= $("#to").val();
    let sendingdata= {
        "from": from,
        "to": to,
        "action": "get_user_statement"
    }
    $.ajax({
        method: "POST",
        datatype: "JSON",
        url: "../Api/expense.php",
        data: sendingdata,
        success: function(data){
            let status= data.status;
            let response= data.data;
            
            let tr= '';
            let th= '';
            if(status){
                response.forEach( res => {

                    th= "<tr>"
                    for(let i in res){
                        th+= `<th>${i}</th>`
                      }
                      th+= "</tr>";    

                    tr+= "<tr>"
                    for(let i in res){
                        tr+= `<td>${res[i]}</td>`
                      }
                      tr+= "</tr>";
                    }); 
                
                $("#userTable thead").append(th);
                $("#userTable tbody").append(tr);
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
