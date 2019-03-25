<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>USERS</h2>
        </div>
        <!-- Basic Examples -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            EDIT USER
                        </h2>
                    </div>
                    <div class="body">
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title" align="center"><?php echo $t_user->display_name ?: '-' ?></h3>
                            </div>
                            <div class="panel-body">
                                <form class="form-horizontal" method="post" action="<?php echo base_url('dashboard/user/update/'.$t_user->user_id);?>">
                                    <div class="row">
                                        <div class="col-md-3 col-lg-3" align="center">
                                            <img src="<?php echo $t_user->picture_url ?>" class="img-circle img-responsive" onerror="this.src='<?php echo base_url('assets/templates/backend/')?>images/avatar.jpg'">
                                        </div>
                                        <div class="col-md-9 col-lg-9">
                                            <div class="row clearfix">
                                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                    <label for="user_id">User ID</label>
                                                </div>
                                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="text" name="user_id" class="form-control" placeholder="<?php echo $t_user->user_id ?: '-' ?>" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row clearfix">
                                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                    <label for="display_name">Display Name</label>
                                                </div>
                                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="text" id="display_name" name="display_name" class="form-control" placeholder="<?php echo $t_user->display_name ?: '-' ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row clearfix">
                                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                    <label for="birth_date">Birth Date</label>
                                                </div>
                                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="text" class="datepicker form-control" name="birth_date" placeholder="<?php echo ($t_user->birth_date ? date('Y-m-d', strtotime($t_user->birth_date)) : 'YYYY-mm-dd');?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row clearfix">
                                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                    <label for="premium">Premium</label>
                                                </div>
                                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="text" class="datetimepicker form-control" name="premium" placeholder="<?php echo ($t_user->premium ? date('Y-m-d H:i', strtotime($t_user->premium)) : 'YYYY-mm-dd HH:ii');?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row clearfix">
                                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                    <label for="available">Available</label>
                                                </div>
                                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                    <input type="radio" class="radio-col-green" name="available" id="available1" <?php echo ($t_user->available==1)?'checked':'' ?> value="1">
                                                    <label for="available1">Yes</label>
                                                    <input type="radio" class="radio-col-red" name="available" id="available0" <?php echo ($t_user->available==0)?'checked':'' ?> value="0">
                                                    <label for="available0">No</label>
                                                </div>
                                            </div>
                                            <div class="row clearfix">
                                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                    <label for="available">Blocked</label>
                                                </div>
                                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                    <input type="radio" class="radio-col-red" name="blocked" id="blocked1" <?php echo ($t_user->blocked==1)?'checked':'' ?> value="1">
                                                    <label for="blocked1">Yes</label>
                                                    <input type="radio" class="radio-col-green" name="blocked" id="blocked0" <?php echo ($t_user->blocked==0)?'checked':'' ?> value="0">
                                                    <label for="blocked0">No</label>
                                                </div>
                                            </div>
                                            <div class="row clearfix">
                                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                    <label for="status_message">Status Message</label>
                                                </div>
                                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <textarea rows="1" class="form-control no-resize auto-growth" name="status_message" placeholder="<?php echo ($t_user->status_message ?: '-');?>"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6" align="left">
                                        <button type="button" class="btn btn-danger waves-effect" id="btndel">
                                            <i class="material-icons">delete</i>
                                        </button>
                                    </div>
                                    <div class="col-md-6" align="right">
                                        <button type="button" class="btn btn-default waves-effect" onclick="location.href='<?php echo base_url('dashboard/user/detail/').$t_user->user_id; ?>'">
                                            <i class="material-icons">keyboard_return</i>
                                        </button>
                                        <button type="submit" class="btn btn-primary waves-effect">
                                            <i class="material-icons">save</i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Basic Examples -->
    </div>
</section>

<?php $this->load->view('js'); ?>