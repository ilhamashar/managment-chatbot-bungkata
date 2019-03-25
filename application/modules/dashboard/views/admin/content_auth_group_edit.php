<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>USERS</h2>
        </div>
        <!-- Basic Examples -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <?php if($this->session->flashdata('message')) echo "<p class=\"".$this->session->flashdata('class')."\">".$this->session->flashdata('message')."</p>"; ?>
                <div class="card">
                    <div class="header">
                        <h2>
                            EDIT GROUP
                        </h2>
                    </div>
                    <div class="body">
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title" align="center"><?php echo $group->name ?></h3>
                            </div>
                            <div class="panel-body">
                                <form class="form-horizontal" method="post">
                                    <div class="row">
                                        <div class="col-md-12 col-lg-12">
                                            <div class="row clearfix">
                                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                    <label for="name">Name</label>
                                                </div>
                                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="text" name="name" class="form-control" placeholder="<?php echo $group->name ?>" autofocus>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row clearfix">
                                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                    <label for="description">Description</label>
                                                </div>
                                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="text" id="description" name="description" class="form-control" placeholder="<?php echo $group->description ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6" align="left">
                                    </div>
                                    <div class="col-md-6" align="right">
                                        <button type="button" class="btn btn-default waves-effect" onclick="location.href='<?php echo base_url() ?>dashboard/user/auth_group'">
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