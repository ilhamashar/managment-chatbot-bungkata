<!-- Left Sidebar -->
<aside id="leftsidebar" class="sidebar">
    <!-- User Info -->
    <div class="user-info">
        <div class="image">
            <?php
            $ava_placeholder = base_url('assets/templates/backend/').'images/user.png';
            if ($user && $user->picture_url){
                $avatar = $user->picture_url;
            } else {
                $avatar = base_url('assets/templates/backend/').'images/user.png';
            }
            ?>
            <img src="<?php echo $avatar; ?>" width="48" height="48" alt="User" onerror="this.src='<?php echo $ava_placeholder ?>'" />
        </div>
        <div class="info-container">
            <?php
            if ($user){
                echo "<div class=\"name\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">$user->display_name</div>";
            }
            ?>
            <div class="email"><?php echo $auth_user->email ?></div>
            <div class="btn-group user-helper-dropdown">
                <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                <ul class="dropdown-menu pull-right">
                    <li><a href="<?php echo base_url();?>dashboard/profile"><i class="material-icons">person</i>Profile</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="<?php echo base_url();?>auth/logout"><i class="material-icons">input</i>Sign Out</a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- #User Info -->
    <!-- Menu -->
    <div class="menu">
        <ul class="list">
            <li class="header">MAIN NAVIGATION</li>
            <li class="<?php echo active_link('home'); ?>">
                <a href="<?php echo base_url();?>dashboard">
                    <i class="material-icons">home</i>
                    <span>Home</span>
                </a>
            </li>
            <?php if ($auth_user->role == 'admin'){ ?>
                <li class=<?php echo active_link("user") ?>>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">account_box</i>
                        <span>Users</span>
                    </a>
                    <ul class="ml-menu">
                        <li class="<?php echo active_link('user', 'auth_group') ?>">
                            <a href="<?php echo base_url();?>dashboard/user/auth_group" >Auth Group</a>
                        </li>
                        <li class="<?php echo active_link('user', 'auth') ?>">
                            <a href="<?php echo base_url();?>dashboard/user/auth" >Auth User</a>
                        </li>
                        <li class="<?php echo active_link('user', 'index') ?>">
                            <a href="<?php echo base_url();?>dashboard/user">LINE user</a>
                        </li>
                    </ul>
                </li>
                <li class="<?php echo active_link('challenge'); ?>">
                    <a href="<?php echo base_url();?>dashboard/challenge">
                        <i class="material-icons">flip_to_front</i>
                        <span>Challenge</span>
                    </a>
                </li>
                <li class="<?php echo active_link('settings'); ?>">
                    <a href="<?php echo base_url();?>dashboard/settings">
                        <i class="material-icons">settings</i>
                        <span>Settings</span>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </div>
    <!-- #Menu -->
    <!-- Footer -->
    <div class="legal">
        <div class="copyright">
            &copy; 2018 <a href="https://www.instagram.com/ilhamashar_/" target="_blank">ilhamashar</a> | All rights reserved
        </div>
        <div class="version">
            <b>Version: </b> 1.0.5
        </div>
    </div>
    <!-- #Footer -->
</aside>
<!-- #END# Left Sidebar -->