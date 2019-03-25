<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>AUTH USERS</h2>
        </div>
        <!-- Basic Examples -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <?php if($this->session->flashdata('message')) echo "<p class=\"".$this->session->flashdata('class')."\">".$this->session->flashdata('message')."</p>"; ?>
                <div class="card">
                    <div class="header">
                        <h2>
                            ALL USERS
                        </h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Role ID</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($groups as $group){
                                    echo "<tr>";
                                    echo "<td>$group->name</td>";
                                    echo "<td>$group->description</td>";
                                    echo "<td>$group->id</td>";
                                    echo "<td><button class=\"btn btn-danger\" onclick=\"location.href='auth_group_delete/$group->id'\"><i class=\"material-icons\">delete</i></button> <button class=\"btn btn-warning\" onclick=\"location.href = 'auth_group_edit/$group->id'\"><i class=\"material-icons\">edit</i></button></td>";;
                                    echo "</tr>";
                                } ?>
                                </tbody>
                            </table>
                            <button type="button" class="btn btn-info waves-effect" onclick="location.href='auth_group_add'">
                                <i class="material-icons">group_add</i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Basic Examples -->
    </div>
</section>

<?php $this->load->view('js'); ?>