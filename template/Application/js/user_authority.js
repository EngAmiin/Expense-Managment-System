loadall();

function loadall(){
    let sendingdata= {
        "action": "read_system_authority",
    }

    $.ajax({
        method: "POST",
        datatype: "JSON",
        url: "../Api/user_authority.php",
        data: sendingdata,
        success: function(data){
            let status= data.status;
            let response= data.data;
            let html= '';
            let role= '';
            let system_links= '';
            let system_actions= '';

            if(status){
                response.forEach( res => {

                   
                    for(let i in res){
                        if(res['role'] !== role){
                            html+=`</fieldset> 
                            </div> </div> 
                            <div class="col-sm-4"> 
                            <fieldset class="authority_border"> 
                            <legend class="authority_border"> 
                            <input type="checkbox" id="" name="" > 
                            ${res['role']} 
                             </legend>`;
                        role= res['role'];
                        }

                        if(res['name'] !== system_links){
                            html+= `<div class="control-group">
                                    <label class="control-label input-label">
                                    <input type="checkbox" name="system_link[]" style="margin-left:25px !important">
                                    ${res['name']} 
                                    </label>`
                          system_links = res['name'];
                        }
    
                        if(res['action_name'] !== system_actions){
                            html+= ` <div class="system_action">
                            <label class="control-label input-label">
                            <input type="checkbox" name="system_link[]" style="margin-left:5px !important">
                            ${res['action_name']} 
                            </label> 
                            </div> `;
    
                            system_actions= res['action_name'];
                        }
    
                    }
                    
                });

                $("#authorityArea").append(html);
              
            }

        },error: function(data){

        }
    })
} 