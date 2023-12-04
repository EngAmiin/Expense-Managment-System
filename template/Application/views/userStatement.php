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
                                      
                                        <form id="userform">
                                        <div class="row">
                                        <div class="col-sm-4">
                                            <select name="type" id="type" class="form-control">
                                                <option value="0">All</option>
                                                <option value="custom">Custom</option>
                                            </select>
                                        </div>

                                        <div class="col-sm-4">
                                            <input type="date" name="from" id="from" class="form-control">
                                        </div>

                                        <div class="col-sm-4">
                                            <input type="date" name="to" id="to" class="form-control">
                                        </div>
                                        <button type="submit" id="addNew" class="btn btn-info m-2 ml-4 mb-3 float-right"><i class="fa fa-plus"></i>  Add New Report</button>
                                    </div>
                                        </form>
                                            <div class="table-responsive" id="print_area">
                                                <img width="80%" height="200px" src="../views/juss.png" alt="" srcset="">
                                                <table class="table" id="userTable">
                                                    <thead>
                                                      
                                                    </thead>
                                                   <tbody>

                                                   </tbody>
                                                </table>
                                            </div>
                                            <button id="print_statement" class="btn btn-danger"><i class="fa fa-print"></i>print</button>
                                            <button id="export_statement" class="btn btn-info"><i class="fa fa-file"></i>Export</button>
                                           
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

<script src="../js/userStatement.js"></script>