<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>My Profile</h2>
        </div>
        <!-- Basic Examples -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <?php if($this->session->flashdata('message')) echo "<p class=\"".$this->session->flashdata('class')."\">".$this->session->flashdata('message')."</p>"; ?>
                <div class="card">
                    <div class="header">
                        <h2>
                            LINE PROFILE
                        </h2>
                    </div>
                    <div class="body">
                        <div class="panel">
                            <?php if ($user) {?>
                            <div class="panel-heading">
                                <h3 class="panel-title" align="center"><?php echo $user->display_name ?: '-' ?></h3>
                            </div>
                            <div class="panel-body">
                                <form class="form-horizontal" method="post" enctype="multipart/form-data" role="form" action="<?php echo base_url('dashboard/profile/update');?>">
                                    <div class="row">
                                        <div class="col-md-3 col-lg-3" align="center">
                                            <img src="<?php echo $user->picture_url ?>" id="avatar" class="img-circle img-responsive" onerror="this.src='<?php echo base_url('assets/templates/backend/')?>images/avatar.jpg'">
                                            <br>
                                            <input type="file" name="userfile" accept="image/*" id="image" onchange="readURL(this)"/>
                                            <div id="btnResetImg">

                                            </div>
                                        </div>
                                        <div class="col-md-9 col-lg-9">
                                            <div class="row clearfix">
                                                <input type="hidden" name="user_id" value="<?php echo $user->user_id; ?>">
                                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                    <label for="uid">User ID</label>
                                                </div>
                                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="text" name="uid" class="form-control" placeholder="<?php echo $user->user_id ?: '-' ?>" disabled>
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
                                                            <input type="text" id="display_name" name="display_name" class="form-control" placeholder="<?php echo $user->display_name ?: '-' ?>">
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
                                                            <input type="text" class="datepicker form-control" name="birth_date" placeholder="<?php echo ($user->birth_date ? date('d-m-Y', strtotime($user->birth_date)) : 'dd-mm-YYYY');?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row clearfix">
                                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                    <label for="status_message">Status Message</label>
                                                </div>
                                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <textarea rows="1" class="form-control no-resize auto-growth" name="status_message" placeholder="<?php echo ($user->status_message ?: '-');?>"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12" align="right">
                                        <button type="reset" class="btn btn-default waves-effect">
                                            <i class="material-icons">clear</i>
                                        </button>
                                        <button type="submit" class="btn btn-primary waves-effect">
                                            <i class="material-icons">save</i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <?php } else {?>
                                <div align="center">
                                <button type="button" class="btn btn-success waves-effect" onclick="location.href='<?php echo base_url('dashboard/profile/connect'); ?>'">
                                    <i class="material-icons">sync</i>
                                    <span>CLICK HERE TO SYNC</span>
                                </button>
                                </div>
                            <?php }?>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="header">
                        <h2>
                            AUTH PROFILE
                        </h2>
                    </div>
                    <div class="body">
                        <div class="panel">
                            <div class="panel-body">
                                <form class="form-horizontal" method="post" action="<?php echo base_url('dashboard/profile/auth_update');?>">
                                    <div class="row">
                                        <div class="col-md-12 col-lg-12">
                                            <div class="row clearfix">
                                                <input type="hidden" name="authid" value="<?php echo $auth_user->id;?>" />
                                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                    <label for="email">Email</label>
                                                </div>
                                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="text" name="email" class="form-control" placeholder="<?php echo $auth_user->email; ?>" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row clearfix">
                                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                    <label for="password">Password</label>
                                                </div>
                                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="password" id="password" name="password" class="form-control" placeholder="password">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12" align="right">
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
<script type="text/javascript">
    // Get the Original image source
    var originalAvatarSrc = $('img').attr('src');
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                document.getElementById('avatar').src=e.target.result;
                document.getElementById('btnResetImg').innerHTML = '<br><a href="#" onclick="reset();" class="btn btn-warning">reset</a>'
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    function reset(){
        $('#image').val("");
        document.getElementById('avatar').src=originalAvatarSrc;
        document.getElementById('btnResetImg').innerHTML = "";
    }
</script>
