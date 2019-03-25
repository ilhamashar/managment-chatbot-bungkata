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
                            DETAIL USER
                        </h2>
                    </div>
                    <div class="body">
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title" align="center"><?php echo $t_user->display_name ?: '-' ?></h3>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-3 col-lg-3" align="center">
                                        <img src="<?php echo $t_user->picture_url; ?>" class="img-circle img-responsive" onerror="this.src='<?php echo base_url('assets/templates/backend/')?>images/avatar.jpg'">
                                        <br>
                                        <div class="smartquote">
                                            <p class="col-teal"><?php echo $t_user->status_message; ?></p>
                                        </div>
                                    </div>
                                    <div class=" col-md-9 col-lg-9 ">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td><b>User ID</b></td>
                                                    <td><?php echo $t_user->user_id; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Type</b></td>
                                                    <td><?php echo ucfirst($t_user->user_type); ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Default Name</b></td>
                                                    <td><?php echo $t_user->display_name_default ?: '-' ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Birth Date</b></td>
                                                    <td><?php echo ($t_user->birth_date ? date('d M Y', strtotime($t_user->birth_date)) : '-');?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Age</b></td>
                                                    <?php if ($t_user->birth_date){
                                                        $from = new DateTime($t_user->birth_date);
                                                        $to   = new DateTime('today');
                                                        $age = $from->diff($to)->y;
                                                        echo "<td>$age</td>";
                                                    } else {
                                                        echo "<td>-</td>";
                                                    } ?>
                                                </tr>
                                                <tr>
                                                    <td><b>Premium</b></td>
                                                    <td><?php echo ($t_user->premium ? date('Y-m-d H:i', strtotime($t_user->premium)) : '-');?></td>
                                                </tr>
                                                <?php
                                                $date=strtotime($t_user->created_at);//Converted to a PHP date (a second count)
                                                //Calculate difference
                                                $diff=time()-$date;//time returns current time in seconds
                                                $days=floor($diff/(60*60*24));//seconds/minute*minutes/hour*hours/day)
                                                $hours=round(($diff-$days*60*60*24)/(60*60));
                                                //Report
                                                $days_joined = $days." days ".$hours." hours ago";
                                                ?>
                                                <tr>
                                                    <td><b>Joined</b></td>
                                                    <td><?php echo $t_user->created_at."<br> (".$days_joined.")"; ?></td>
                                                </tr>
                                                <?php
                                                if ($t_user->updated_at){
                                                    $date=strtotime($t_user->updated_at);//Converted to a PHP date (a second count)
                                                    //Calculate difference
                                                    $diff=time()-$date;//time returns current time in seconds
                                                    $days=floor($diff/(60*60*24));//seconds/minute*minutes/hour*hours/day)
                                                    $hours=round(($diff-$days*60*60*24)/(60*60));
                                                    //Report
                                                    $last_update = $days." days ".$hours." hours ago";
                                                }
                                                ?>
                                                <tr>
                                                    <td><b>Last Update</b></td>
                                                    <td><?php echo ($t_user->updated_at ? $t_user->updated_at."<br> (".$last_update.")" : '-'); ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Data</b></td>
                                                    <td><?php
                                                        $json_string = json_encode($t_user->pref_data, JSON_PRETTY_PRINT);
                                                        echo $json_string;
                                                        ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <?php if ($t_user->available){
                                        echo '<button type="button" class="btn btn-success waves-effect" id="btnavail" data-uid='.$t_user->user_id.' data-status="0">';
                                        echo '<i class="material-icons">how_to_reg</i></button>';
                                    } else {
                                        echo '<button type="button" class="btn btn-danger waves-effect" id="btnavail" data-uid='.$t_user->user_id.' data-status="1">';
                                        echo '<i class="material-icons">voice_over_off</i></button>';
                                    }?>

                                    <?php
                                    if ($t_user->blocked){
                                        echo '<button type="button" class="btn btn-danger waves-effect" id="btnblock" data-uid='.$t_user->user_id.' data-status="0">';
                                        echo '<i class="material-icons">block</i></button>';
                                    } else {
                                        echo '<button type="button" class="btn btn-success waves-effect" id="btnblock" data-uid='.$t_user->user_id.' data-status="1">';
                                        echo '<i class="material-icons">done</i></button>';
                                    }?>
                                </div>
                                <div class="col-md-2" align="right">
                                    <button type="button" class="btn btn-warning waves-effect" onclick="location.href='<?php echo base_url('dashboard/user/edit/').$t_user->user_id; ?>'">
                                        <i class="material-icons">edit</i>
                                    </button>
                                </div>
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
<script type="text/javascript" src="<?php echo base_url('assets/templates/backend/');?>plugins/sweetalert/sweetalert.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/templates/backend/');?>js/dashboard-user-sweetalert.js"></script>
