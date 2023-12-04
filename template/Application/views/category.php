<?php 

include ('header.php');
include ('sidepar.php');

?>

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
                                            <h5>Basic Table</h5>
                                            <span class="d-block m-t-5">use class <code>table</code> inside table element</span>
                                        </div>
                                        <div class="card-block table-border-style">
                                            <div class="table-responsive">
                                                <button id="addNew" class="btn btn-info mb-3 float-right">Add New Transaction</button>
                                                <table class="table" id="categoryTable">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Name</th>
                                                            <th>Icon</th>
                                                            <th>Role</th>
                                                            <th>Date</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                   <tbody>

                                                   </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal" tabindex="-1" role="dialog" id="categoryModal">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                  <form id="categoryForm">

                                  <div class="row">
                                    <div class="col-sm-12">
                                    <div class="alert alert-success d-none" role="alert">
                                        This is a success alert—check it out!
                                        </div>
                                        <div class="alert alert-danger d-none" role="alert">
                                        This is a danger alert—check it out!
                                    </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="">Name</label>
                                            <input type="text" name="name" id="name" class="form-control">
                                        </div>
                                    </div>
 
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="">Icon</label>
                                            <input type="text" name="icon" id="icon" class="form-control">
                                        </div>
                                    </div>  
            
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="">Role</label>
                                            <select name="role" id="role" class="form-control">
                                                <option value="Subscriber">
                                                    Subscriber
                                                </option>
                                                <option value="SuperAdmin">
                                                    SuperAdmin
                                                </option>
                                                <option value="Dashboard">
                                                    Dashboard  
                                                </option>
                                            </select>                                        
                                        </div>
                                    </div>

                                 
                                </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                                </div>
                            </div>
                            </div>
                            <!-- [ Main Content ] end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <input id="update_id" hidden/>
    </div>

<?php

include ('footer.php');

?>

<script src="../js/category.js"></script>