<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>AUTH USERS</h2>
        </div>
        <!-- Basic Examples -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <?php if($this->session->flashdata('message')) echo "<p class=\"".$this->session->flashdata('class')."\">".$this->session->flashdata('message')."</p>"; ?>
                <div class="card">
                    <div class="header">
                        <h2>
                            ALL USERS
                        </h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table id="authusertable" class="table table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Display Name</th>
                                    <th>Last Login</th>
                                    <th>Joined</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>No.</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Display Name</th>
                                    <th>Last Login</th>
                                    <th>Joined</th>
                                    <th>Action</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <button type="button" class="btn btn-info waves-effect" onclick="location.href='<?php echo base_url('dashboard/user/auth_add'); ?>'">
                            <i class="material-icons">person_add</i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Basic Examples -->
    </div>
</section>

<?php $this->load->view('js'); ?>
<script type="text/javascript" src="<?php echo base_url('assets/templates/backend/');?>js/usertable-data.js"></script>