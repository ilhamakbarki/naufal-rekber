                        <div class="row">
                        	<div class="col-sm-12">
                        		<div class="card">
                        		    <div class="card-body">
                            		    <h4 class="card-title mb-4"><i class="uil-users-alt text-primary"></i> Daftar Akun</h4>
                                        <form>
                                        	<div class="row">
                                        		<div class="col-md-12">
                                        		    <div class="mb-3">
                                            		    <div class="input-group">
                                                            <input type="text" class="form-control" name="value" placeholder="Cari Data" value="<?= $this->input->get('value') ?>">
                                                            <span class="input-group-append">
            													<button type="submit" class="btn btn-primary">
            														<i class="uil-search"></i>
            													</button>
                                                            </span>
                                            		    </div>
                                        		    </div>
                                        		</div>
                                        	</div>
                                        </form>
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                            	<thead>
                                            		<tr>
                                            			<th>ID</th>
                                            			<th>NAMA&nbsp;LENGKAP</th>
                                            			<th>USERNAME</th>
                                            			<th>EMAIL</th>
                                            			<th>NOMOR&nbsp;HP</th>
                                            			<th>LEVEL</th>
                                            			<th>PROFIL</th>
                                            			<th>STATUS</th>
                                            			<th>TANGGAL&nbsp;&&nbsp;WAKTU&nbsp;DAFTAR</th>
                                            			<th>TANGGAL&nbsp;&&nbsp;WAKTU&nbsp;UPDATE</th>
                                            			<th>AKSI</th>
                                            		</tr>
                                            	</thead>
                                            	<tbody>
                                                    <?php
                                                    foreach ($table as $key => $value) {
                                                    if ($value['image'] == 'male.png') {
                                                        $image = 'assets/images/male.png';
                                                    } else {
                                                        $image = 'assets/images/profile/'.$value['image'].'';
                                                    }
                                                    ?>

                                                    <tr>
                                                        <td><?= $value['user_id'] ?></td>
                                                        <td><?= $value['full_name'] ?></td>
                                                        <td><?= $value['username'] ?></td>
                                                        <td><?= $value['email'] ?></td>
                                                        <td><?= $value['phone'] ?></td>
                                                        <td><?= $value['level_name'] ?></td>
                                                        <td><img src="<?= base_url() ?><?= $image ?>" width="50"></td>
                                        				<td><span class="badge badge-<?= $status[$value['status']]['color'] ?>"><?= $status[$value['status']]['status'] ?></span></td>
                                        				<td><?= $this->lib->format_date($value['created_at']) ?>, <?= $this->lib->format_time($value['created_at']) ?></td>
                                        				<td><?= $this->lib->format_date($value['update_at']) ?>, <?= $this->lib->format_time($value['update_at']) ?></td>
                                            			<td align="center">
                                            				<a href="<?= base_url('admin/'.$this->uri->segment(2).'/edit/'.$value['user_id']) ?>" class="btn btn-warning btn-sm"><i class="uil-edit"></i></a> 
                                            				<a href="javascript: void(0);" onclick="confirm_delete('<?= base_url('admin/'.$this->uri->segment(2).'/delete/'.$value['user_id']) ?>')" class="btn btn-danger btn-sm"><i class="uil-trash"></i></a>
                                            			</td>
                                            		</tr>
                                                    <?php } ?>

                                            	</tbody>
                                            </table>
                                            <div>
                                            	<ul class="pagination pagination-split" style="margin: 20px 0;">
                                            	    <li class="disabled page-item">
                                            	        <a class="page-link" href="#">Total Data : <?= $total_data ?></a>
                                            	    </li>
                                            	    <?= $this->pagination->create_links() ?>
    
                                            	</ul>
                                            </div>
                                        </div>
                        	    	</div>
                        		</div>
                        	</div>
                        </div>