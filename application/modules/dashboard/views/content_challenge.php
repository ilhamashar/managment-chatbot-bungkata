<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>CHALLENGE</h2>
        </div>
        <!--Basic Example-->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <!-- <?php //if($this->session->flashdata('message')) echo "<p class=\"".$this->session->flashdata('class')."\">".$this->session->flashdata('message')."</p>"; ?> -->
                <div class="card">
                    <div class="header">
                        <h2>
                            Daftar Challenge
                        </h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                        	<!-- <?php //print_r($row); ?> -->
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                	<th>Nama</th>
                                	<th>Tipe</th>
                                	<th>Gambar</th>
                                	<th>Deskripsi</th>
                                	<th>XP</th>
                                	<th>Point</th>
                                	<th>Badge</th>
                                	<th>Aktif</th>
                                	<th>Mulai</th>
                                	<th>Selesai</th>
                                	<th>Game</th>
                                	<th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                	<th>Nama</th>
                                	<th>Tipe</th>
                                	<th>Gambar</th>
                                	<th>Deskripsi</th>
                                	<th>XP</th>
                                	<th>Point</th>
                                	<th>Badge</th>
                                	<th>Aktif</th>
                                	<th>Mulai</th>
                                	<th>Selesai</th>
                                	<th>Game</th>
                                	<th>Action</th>
                                </tr>
                                <!-- <?php// foreach ($challenge as $challenge){
                                    // echo "<tr>";
                                    // echo "<td>$challenge->id</td>";
                                    // echo "<td>$challenge->challenge_name</td>";
                                    // echo "<td>$challenge->challenge_type</td>";
                                    // echo "<td>$challenge->challenge_image</td>";
                                    // echo "<td>$challenge->description</td>";
                                    // echo "<td>$challenge->reward_xp</td>";
                                    // echo "<td>$challenge->reward_point</td>";
                                    // echo "<td>$challenge->reward_badge</td>";
                                    // echo "<td>$challenge->is_active</td>";
                                    // echo "<td>$challenge->started_at</td>";
                                    // echo "<td>$challenge->expired_at</td>";
                                    // echo "<td><button class=\"btn btn-danger\" onclick=\"location.href='auth_group_delete/$challenge->id'\"><i class=\"material-icons\">delete</i></button> <button class=\"btn btn-warning\" onclick=\"location.href = 'auth_group_edit/$challenge->id'\"><i class=\"material-icons\">edit</i></button></td>";;
                                    // echo "</tr>";
                                } ?> -->
                                </tbody>
                            </table>
                            <button type="button" class="btn btn-info waves-effect" onclick="location.href='challenge_add'">
                                <i class="material-icons">group_add</i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>
</section>
<?php $this->load->view('js'); ?>
<script type="text/javascript" src="<?php echo base_url('assets/templates/backend/');?>js/usertable-data.js"></script>