
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title><?php echo $page_title; ?></title>
    <!-- Favicon-->
    <link rel="icon" href="<?php echo base_url('assets/templates/backend/'); ?>favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="<?php echo base_url('assets/templates/backend/'); ?>plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="<?php echo base_url('assets/templates/backend/'); ?>plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="<?php echo base_url('assets/templates/backend/'); ?>plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="<?php echo base_url('assets/templates/backend/'); ?>css/style.css" rel="stylesheet">
</head>

<body class="fp-page">
<div class="fp-box">
    <div class="logo">
        <a href="javascript:void(0);">BOT<b>Panel</b></a>
        <small>LINE Bot Control Panel</small>
    </div>
    <div class="card">
        <div class="body">
            <?php if($success){?>
                <?php if($this->session->flashdata('message')) echo "<p class=\"".$this->session->flashdata('class')."\">".$this->session->flashdata('message')."</p>"; ?>
            <?php } else {?>
            <form id="forgot_password" method="POST">
                <?php if($this->session->flashdata('message')) echo "<p class=\"".$this->session->flashdata('class')."\">".$this->session->flashdata('message')."</p>"; ?>
                <div class="msg">
                    Enter your email address that you used to register. We'll send you an email with your username and a
                    link to reset your password.
                </div>
                <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">email</i>
                        </span>
                    <div class="form-line">
                        <input type="email" class="form-control" name="email" placeholder="Email" required autofocus>
                    </div>
                </div>

                <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit">RESET MY PASSWORD</button>

                <div class="row m-t-20 m-b--5 align-center">
                    <a href="<?php echo base_url('auth/login') ;?>">Sign In!</a>
                </div>
            </form>
            <?php };?>
        </div>
    </div>
</div>

<!-- Jquery Core Js -->
<script src="<?php echo base_url('assets/templates/backend/'); ?>plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap Core Js -->
<script src="<?php echo base_url('assets/templates/backend/'); ?>plugins/bootstrap/js/bootstrap.js"></script>

<!-- Waves Effect Plugin Js -->
<script src="<?php echo base_url('assets/templates/backend/'); ?>plugins/node-waves/waves.js"></script>

<!-- Validation Plugin Js -->
<script src="<?php echo base_url('assets/templates/backend/'); ?>plugins/jquery-validation/jquery.validate.js"></script>

<!-- Custom Js -->
<script src="<?php echo base_url('assets/templates/backend/'); ?>js/admin.js"></script>
<script src="<?php echo base_url('assets/templates/backend/'); ?>js/pages/examples/forgot-password.js"></script>
</body>

</html>