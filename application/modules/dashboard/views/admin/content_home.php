<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>DASHBOARD</h2>
        </div>

        <!-- Widgets -->
        <div class="row clearfix">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-orange hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">person_add</i>
                    </div>
                    <div class="content">
                        <div class="text">NEW RECORDS</div>
                        <div class="number count-to" data-from="0" data-to="<?php echo $dashboard['new_user_today']; ?>" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-blue-grey hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">person</i>
                    </div>
                    <div class="content">
                        <div class="text">ALL USERS</div>
                        <div class="number count-to" data-from="0" data-to="<?php echo $dashboard['total_user']; ?>" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-light-blue hover-zoom-effect">
                    <div class="icon">
                        <i class="material-icons">mood</i>
                    </div>
                    <div class="content">
                        <div class="text">AVAILABLE USERS</div>
                        <div class="number count-to" data-from="0" data-to="<?php echo $dashboard['available_user']; ?>" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-green hover-zoom-effect">
                    <div class="icon">
                        <i class="material-icons">update</i>
                    </div>
                    <div class="content">
                        <div class="text">ONLINE</div>
                        <div class="number count-to" data-from="0" data-to="<?php echo $dashboard['latest_online']; ?>" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Widgets -->

        <div class="row clearfix">
            <!-- Area Chart -->
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>AVAILABLE USER CHART</h2>
                    </div>
                    <div class="body">
                        <div id="line_chart" class="graph"></div>
                    </div>
                </div>
            </div>

            <!--Chart statistik permainan dala  7 hari -->
<!--             <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>STATISTIK PERMAINAN DALAM 7 HARI</h2>
                    </div>
                    <div class="body"> -->
                        <!-- <div id="line_chart7day" class="graph"></div> -->
<!--                     </div>
                </div>
            </div> -->

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>STATISTIK PERMAINAN DALAM 7 HARI</h2>
                    </div>
                        <div class="body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                                <!-- <li role="presentation" class="active"><a href="#home" data-toggle="tab">7 Hari</a></li> -->
                                <li role="presentation" class="active"><a href="#hari1" data-toggle="tab"><?php $tgl=date('d-m-Y', strtotime("-1 day", strtotime(date("Y-m-d")))); echo $tgl; ?></a></li>
                                <li role="presentation" ><a href="#hari2" data-toggle="tab"><?php $tgl=date('d-m-Y', strtotime("-2 day", strtotime(date("Y-m-d")))); echo $tgl; ?></a></li>
                                <li role="presentation" ><a href="#hari3" data-toggle="tab"><?php $tgl=date('d-m-Y', strtotime("-3 day", strtotime(date("Y-m-d")))); echo $tgl; ?></a></li>
                                <li role="presentation" ><a href="#hari4" data-toggle="tab"><?php $tgl=date('d-m-Y', strtotime("-4 day", strtotime(date("Y-m-d")))); echo $tgl; ?></a></li>
                                <li role="presentation" ><a href="#hari5" data-toggle="tab"><?php $tgl=date('d-m-Y', strtotime("-5 day", strtotime(date("Y-m-d")))); echo $tgl; ?></a></li>
                                <li role="presentation" ><a href="#hari6" data-toggle="tab"><?php $tgl=date('d-m-Y', strtotime("-6 day", strtotime(date("Y-m-d")))); echo $tgl; ?></a></li>
                                <li role="presentation" ><a href="#hari7" data-toggle="tab"><?php $tgl=date('d-m-Y', strtotime("-7 day", strtotime(date("Y-m-d")))); echo $tgl; ?></a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="home">
                                    <div id="line_chart7day" class="graph"></div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade in active" id="hari1">
                                    <div id="line_chartHari1" class="graph"></div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade in active" id="hari2">
                                    <div id="line_chartHari2" class="graph"></div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade in active" id="hari3">
                                    <div id="line_chartHari3" class="graph"></div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade in active" id="hari4">
                                    <div id="line_chartHari4" class="graph"></div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade in active" id="hari5">
                                    <div id="line_chartHari5" class="graph"></div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade in active" id="hari6">
                                    <div id="line_chartHari6" class="graph"></div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade in active" id="hari7">
                                    <div id="line_chartHari7" class="graph"></div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            <!-- #END# Area Chart -->
        </div>
    </div>
</section>

<?php $this->load->view('js'); ?>
<script src="<?php echo base_url('assets/templates/backend/'); ?>plugins/jquery-countto/jquery.countTo.js"></script>
<script src="<?php echo base_url('assets/templates/backend/'); ?>plugins/raphael/raphael.min.js"></script>
<script src="<?php echo base_url('assets/templates/backend/'); ?>plugins/morrisjs/morris.js"></script>

<script>
    $(function () {
        //Widgets count
        $('.count-to').countTo();
    });
    Morris.Line({
        element: 'line_chart',
        data: <?php echo $dashboard['adder_stats']; ?>,
        xkey: 'day',
        ykeys: ['total', 'user', 'group', 'room'],
        labels: ['All records','Available User', 'Available Group', 'Available Room'],
        pointSize: 2,
        hideHover: 'auto',
        stacked: true,
        lineColors: ['rgb(153, 153, 102)', 'rgb(233, 30, 99)', 'rgb(0, 188, 212)', 'rgb(255, 204, 0)']
    });
        Morris.Line({
        element: 'line_chart7day',
        data: <?php echo $dashboard['sevenday_weekstats']; ?>,
        xkey: 'week',
        ykeys: ['ordinal', 'group', 'alone', 'multiplayer','bungkata','endless'],
        labels: ['Ordinal','Group', 'Alone', 'Multiplayer','BungKata','Endless'],
        pointSize: 6,
        hideHover: 'auto',
        stacked: true,
        lineColors: ['rgb(0, 115, 153)', 'rgb(233, 30, 99)', 'rgb(0, 188, 212)', 'rgb(255, 204, 0)','rgb(22, 251, 2)', 'rgb(206, 100, 20)'] 
    });
     Morris.Line({
        element: 'line_chartHari1',
        data: <?php echo $dashboard['harisatu_stat']; ?>,
        xkey: 'jam1',
        ykeys: ['ordinal', 'group', 'alone', 'multiplayer','bungkata','endless'],
        labels: ['Ordinal','Group', 'Alone', 'Multiplayer','BungKata','Endless'],
        pointSize: 6,
        hideHover: 'auto',
        stacked: true,
        lineColors: ['rgb(0, 115, 153)', 'rgb(233, 30, 99)', 'rgb(0, 188, 212)', 'rgb(255, 204, 0)','rgb(22, 251, 2)', 'rgb(206, 100, 20)'] 
    });
     Morris.Line({
        element: 'line_chartHari2',
        data: <?php echo $dashboard['harikedua_stat']; ?>,
        xkey: 'jam2',
        ykeys: ['ordinal', 'group', 'alone', 'multiplayer','bungkata','endless'],
        labels: ['Ordinal','Group', 'Alone', 'Multiplayer','BungKata','Endless'],
        pointSize: 6,
        hideHover: 'auto',
        stacked: true,
        lineColors: ['rgb(0, 115, 153)', 'rgb(233, 30, 99)', 'rgb(0, 188, 212)', 'rgb(255, 204, 0)','rgb(22, 251, 2)', 'rgb(206, 100, 20)'] 
    });
      Morris.Line({
        element: 'line_chartHari3',
        data: <?php echo $dashboard['hariketiga_stat']; ?>,
        xkey: 'jam3',
        ykeys: ['ordinal', 'group', 'alone', 'multiplayer','bungkata','endless'],
        labels: ['Ordinal','Group', 'Alone', 'Multiplayer','BungKata','Endless'],
        pointSize: 6,
        hideHover: 'auto',
        stacked: true,
        lineColors: ['rgb(0, 115, 153)', 'rgb(233, 30, 99)', 'rgb(0, 188, 212)', 'rgb(255, 204, 0)','rgb(22, 251, 2)', 'rgb(206, 100, 20)'] 
    });
     Morris.Line({
        element: 'line_chartHari4',
        data: <?php echo $dashboard['harikeempat_stat']; ?>,
        xkey: 'jam4',
        ykeys: ['ordinal', 'group', 'alone', 'multiplayer','bungkata','endless'],
        labels: ['Ordinal','Group', 'Alone', 'Multiplayer','BungKata','Endless'],
        pointSize: 6,
        hideHover: 'auto',
        stacked: true,
        lineColors: ['rgb(0, 115, 153)', 'rgb(233, 30, 99)', 'rgb(0, 188, 212)', 'rgb(255, 204, 0)','rgb(22, 251, 2)', 'rgb(206, 100, 20)'] 
    });
    Morris.Line({
        element: 'line_chartHari5',
        data: <?php echo $dashboard['harikelima_stat']; ?>,
        xkey: 'jam5',
        ykeys: ['ordinal', 'group', 'alone', 'multiplayer','bungkata','endless'],
        labels: ['Ordinal','Group', 'Alone', 'Multiplayer','BungKata','Endless'],
        pointSize: 6,
        hideHover: 'auto',
        stacked: true,
        lineColors: ['rgb(0, 115, 153)', 'rgb(233, 30, 99)', 'rgb(0, 188, 212)', 'rgb(255, 204, 0)','rgb(22, 251, 2)', 'rgb(206, 100, 20)'] 
    });
    Morris.Line({
        element: 'line_chartHari6',
        data: <?php echo $dashboard['harienam_stat']; ?>,
        xkey: 'jam6',
        ykeys: ['ordinal', 'group', 'alone', 'multiplayer','bungkata','endless'],
        labels: ['Ordinal','Group', 'Alone', 'Multiplayer','BungKata','Endless'],
        pointSize: 6,
        hideHover: 'auto',
        stacked: true,
        lineColors: ['rgb(0, 115, 153)', 'rgb(233, 30, 99)', 'rgb(0, 188, 212)', 'rgb(255, 204, 0)','rgb(22, 251, 2)', 'rgb(206, 100, 20)'] 
    });
    Morris.Line({
        element: 'line_chartHari7',
        data: <?php echo $dashboard['haritujuh_stat']; ?>,
        xkey: 'jam7',
        ykeys: ['ordinal', 'group', 'alone', 'multiplayer','bungkata','endless'],
        labels: ['Ordinal','Group', 'Alone', 'Multiplayer','BungKata','Endless'],
        pointSize: 6,
        hideHover: 'auto',
        stacked: true,
        lineColors: ['rgb(0, 115, 153)', 'rgb(233, 30, 99)', 'rgb(0, 188, 212)', 'rgb(255, 204, 0)','rgb(22, 251, 2)', 'rgb(206, 100, 20)'] 
    });
</script>