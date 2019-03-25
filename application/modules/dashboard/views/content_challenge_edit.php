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
                            EDIT CHALLENGE
                        </h2>
                    </div>
                    <div class="body">
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title" align="center"><?php echo $t_user->email ?: '-' ?></h3>
                            </div>
<?php $this->load->view('js'); ?>