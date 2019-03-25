<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>SETTINGS</h2>
        </div>
        <!-- Basic Examples -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <div class="row clearfix">
                            <div class="col-xs-12 col-sm-6">
                                <h2>BOT SETTINGS</h2>
                            </div>
                            <div class="col-xs-12 col-sm-6 align-right">
                                <div class="switch panel-switch-btn">
                                    <span class="m-r-10 font-12">MAINTENANCE</span>
                                    <label>OFF<input type="checkbox" id="maintenance" <?php if ($settings['maintenance']) echo 'checked';?>><span class="lever switch-col-cyan"></span>ON</label>
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
<script>
    $('#maintenance').on('change', function () {
        maintenance = this.checked ? '1' : '0';
        $.ajax({
            url: '<?php echo base_url()?>dashboard/settings/update',
            type: 'POST',
            data: {'maintenance':maintenance},
            success: function(data){
                alert(data);
            }
        });
    });
</script>
