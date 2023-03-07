                        <div class="row">
                        	<div class="col-sm-12">
                        		<div class="card">
                        		    <div class="card-body">
                        			    <div class="float-end">
                            		        <a href="<?= base_url('admin/'.$this->uri->segment(2).'/add') ?>" class="btn btn-success btn-sm"><i class="uil-plus"></i> Tambah Metode Payment</a>
                        			    </div>
                        		        <h4 class="card-title mb-4"><i class="uil-credit-card text-primary"></i> Daftar Metode Payment</h4>
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
                                            			<th>KATEGORI</th>
                                            			<th>METODE&nbsp;PAYMENT</th>
                                            			<th>FEE</th>
                                            			<th>GAMBAR</th>
                                            			<th>STATUS</th>
                                            			<th>AKSI</th>
                                            		</tr>
                                            	</thead>
                                            	<tbody>
                                                    <?php
                                                    foreach ($table as $key => $value) {
                                                    ?>

                                            		<tr>
                                            			<td><?= $value['id'] ?></td>
                                            			<td><?= $value['category'] ?></td>
                                            			<td><?= $value['payment_method_name'] ?></td>
                                        				<td>Rp <?= number_format($value['fee'],0,',','.') ?></td>
                                            			<td><img src="<?= base_url() ?>assets/images/payment/<?= $value['image'] ?>" width="50"></td>
                                            			<td><h4><i class="<?= ($value['status'] == '1') ? 'uil-check-circle text-success' : 'uil-times-circle text-danger' ?>"></i></h4></td>
                                                        <td align="center">
                                                            <a href="<?= base_url('admin/'.$this->uri->segment(2).'/edit/'.$value['id']) ?>" class="btn btn-warning btn-sm"><i class="uil-edit"></i></a> 
                                                            <a href="javascript: void(0);" onclick="confirm_delete('<?= base_url('admin/'.$this->uri->segment(2).'/delete/'.$value['id']) ?>')" class="btn btn-danger btn-sm"><i class="uil-trash"></i></a>
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