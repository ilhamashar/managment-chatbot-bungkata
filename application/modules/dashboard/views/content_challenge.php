<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>CHALLENGE</h2>
        </div>
        <!--Basic Example-->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <?php if($this->session->flashdata('message')) echo "<p class=\"".$this->session->flashdata('class')."\">".$this->session->flashdata('message')."</p>"; ?>
                <div class="card">
                    <div class="header">
                        <h2>
                            DAFTAR CHALLENGE
                        </h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                        	<!-- <?php //print_r($row); ?> -->
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>No</th>
                                	<th>Nama</th>
                                    <th>Gambar</th>
                                	<th>Tipe</th>
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
                                	<?php foreach ($challenge as $c){
                                        echo "<tr>";
                                        echo "<td>$c->id</td>";
                                        echo "<td>$c->challenge_name</td>"; 
                                        // echo "<img src='".htmlspecialchars($c['picture_url'])."' height='48' width='48' onerror=\"this.src='".base_url('assets/templates/backend/')."images/avatar.jpg'\"/>";
                                        echo "<td>$c->challenge_image</td>";
                                        echo "<td>$c->challenge_type</td>";
                                        echo "<td>$c->description</td>";
                                        echo "<td>$c->reward_xp</td>";
                                        echo "<td>$c->reward_point</td>";
                                        echo "<td>$c->reward_badge</td>";
                                        echo "<td>$c->is_active</td>";
                                        echo "<td>$c->started_at</td>";
                                        echo "<td>$c->expired_at</td>";
                                        echo "<td>$c->challenge_data</td>";
                                        echo "<td><button class=\"btn btn-danger\" onclick=\"location.href='challenge_delete/$c->id'\"><i class=\"material-icons\">delete</i></button> <button class=\"btn btn-warning\" onclick=\"location.href = 'challenge_edit/$c->id'\"><i class=\"material-icons\">edit</i></button></td>";;
                                        echo "</tr>";
                                    } ?>
                                </tbody>
                                <tfoot>
                                </tfoot>
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