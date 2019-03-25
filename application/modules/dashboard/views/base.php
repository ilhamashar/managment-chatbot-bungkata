<!DOCTYPE html>
<html>
<head>
    <?php $this->load->view('meta'); ?>
</head>
<body class="theme-red">
    <?php $this->load->view('header'); ?>
    <section>
        <?php $this->load->view('sidebar'); ?>
    </section>
    <?php $this->load->view(@$page); ?>
</body>
</html>