<?php 

include ('header.php');
include ('sidepar.php');

?>


<style>
    fieldset.authority_border{
        border: 1px groove #add !important;
        padding: 0 1.4em 1.4em 1.4em !important;
        margin:  0 0 1.5em 0 !important;
        -webkit-box-shadow: 0px 0px 0px 0px #000;
                box-shadow: 0px 0px 0px 0px #000;
    }
    legend.authority_border{
        width: inherit;
        padding: 0  10px;
        border-bottom: none;
    }

    input[type=checkbox]{
        transform: scale(1.5);
    }
    #All_Authority{
        transform: scale(2);
    }
</style>

<div class="pcoded-main-container">
        <div class="pcoded-wrapper">
            <div class="pcoded-content">
                <div class="pcoded-inner-content">
                    <!-- [ breadcrumb ] start -->

                    <!-- [ breadcrumb ] end -->
                    <div class="main-body">
                        <div class="page-wrapper">
                            <!-- [ Main Content ] start -->
        
                            <div class="row">
                            <div class="col-xl-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>User Authority</h5>
                                            <span class="d-block m-t-5">use class <code>table</code> inside table element</span>
                                        </div>
                                        <div class="card-block table-border-style">
                                      
                                        <form id="userform">
                                        <div class="row">
                                            
                                        <div class="col-sm-12">
                                            <select name="user_id" id="user_id" class="form-control">
                                                <option value="0">Select User</option>
                                               
                                            </select> 
                                        </div>
                                     
                                    </div>


                                    <div class="row"> 
                                        <div class="col-sm-12">
                                            <fieldset class="authority_border">
                                                <legend class="authority_border">
                                                    <input type="checkbox" id="all_authority" name="all_authority">
                                                    All Authorities 
                                                </legend>


                                                <div class="row" id="authorityArea">
                                                    
                                                    <!-- <div class="col-sm-4">
                                                      <fieldset class="authority_border">
                                                        <legend class="authority_border">
                                                        <input type="checkbox" id="" name="">
                                                           Subscriber
                                                        </legend>

                                                        <label for="">
                                                        <input type="checkbox" id="" name="" style="margin:10px;">
                                                        Dashboard
                                                        </label>
                                                        <div class="link_actions">
                                                            <label for="">
                                                            <input type="checkbox" id="" name="" style="margin-left:20px !important;">
                                                             Name 
                                                            </label>
                                                        </div>
                                                        <div class="link_actions">
                                                            <label for="">
                                                            <input type="checkbox" id="" name="" style="margin-left:20px !important;">
                                                             Name 
                                                            </label>
                                                        </div>
                                                        <div class="link_actions">
                                                            <label for="">
                                                            <input type="checkbox" id="" name="" style="margin-left:20px !important;">
                                                             Name 
                                                            </label>
                                                        </div>
                                                      </fieldset>
                                                    </div>


                                                    <div class="col-sm-4">
                                                      <fieldset class="authority_border">
                                                        <legend class="authority_border">
                                                        <input type="checkbox" id="" name="">
                                                           Subscriber
                                                        </legend>

                                                        <label for="">
                                                        <input type="checkbox" id="" name="" style="margin:10px;">
                                                        Dashboard
                                                        </label>
                                                        <div class="link_actions">
                                                            <label for="">
                                                            <input type="checkbox" id="" name="" style="margin-left:20px !important;">
                                                             Name 
                                                            </label>
                                                        </div>
                                                        <div class="link_actions">
                                                            <label for="">
                                                            <input type="checkbox" id="" name="" style="margin-left:20px !important;">
                                                             Name 
                                                            </label>
                                                        </div>
                                                        <div class="link_actions">
                                                            <label for="">
                                                            <input type="checkbox" id="" name="" style="margin-left:20px !important;">
                                                             Name 
                                                            </label>
                                                        </div>
                                                      </fieldset>
                                                    </div>
                                                    
                                                    <div class="col-sm-4">
                                                      <fieldset class="authority_border">
                                                        <legend class="authority_border">
                                                        <input type="checkbox" id="" name="">
                                                           Subscriber
                                                        </legend>

                                                        <label for="">
                                                        <input type="checkbox" id="" name="" style="margin:10px;">
                                                        Dashboard
                                                        </label>
                                                        <div class="link_actions">
                                                            <label for="">
                                                            <input type="checkbox" id="" name="" style="margin-left:20px !important;">
                                                             Name 
                                                            </label>
                                                        </div>
                                                        <div class="link_actions">
                                                            <label for="">
                                                            <input type="checkbox" id="" name="" style="margin-left:20px !important;">
                                                             Name 
                                                            </label>
                                                        </div>
                                                        <div class="link_actions">
                                                            <label for="">
                                                            <input type="checkbox" id="" name="" style="margin-left:20px !important;">
                                                             Name 
                                                            </label>
                                                        </div>
                                                      </fieldset>
                                                    </div> -->
                                                   

                                                    
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <button type="submit" id="submit" class="btn btn-info m-2 ml-3 mb-3 ">Authorize_User</button>
                                        </form>
                                         
                                           
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <!-- [ Main Content ] end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php

include ('footer.php');

?>

<script src="../js/user_authority.js"></script>