                        <div class="row">
                        	<div class="col-sm-12">
                        		<div class="card">
                        		    <div class="card-body">
                            		    <h4 class="card-title mb-4"><i class="uil-comment text-primary"></i> Chat</h4>
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
                                            			<th>KODE&nbsp;TRANSAKSI</th>
                                            			<th>STATUS PENJUAL</th>
                                            			<th>STATUS PEMBELI</th>
                                            			<th>TANGGAL&nbsp;&&nbsp;WAKTU&nbsp;DIBUAT</th>
                                            			<th>TANGGAL&nbsp;&&nbsp;WAKTU&nbsp;UPDATE</th>
                                            			<th>AKSI</th>
                                            		</tr>
                                            	</thead>
                                            	<tbody>
                                                    <?php
                                                    foreach ($table as $key => $value) {
                                                    ?>
    
                                        			<tr>
                                        				<td><?= $value['id'] ?></td>
                                        				<td><?= $value['order_id'] ?></td>
                                        				<td><h4><i class="<?= ($value['status_seller'] == '1') ? 'uil-check-circle text-success' : 'uil-times-circle text-danger' ?>"></i></h4></td>
                                        				<td><h4><i class="<?= ($value['status_buyyer'] == '1') ? 'uil-check-circle text-success' : 'uil-times-circle text-danger' ?>"></i></h4></td>
                                        				<td><?= $this->lib->format_date($value['created_at']) ?>, <?= $this->lib->format_time($value['created_at']) ?></td>
                                        				<td><?= $this->lib->format_date($value['update_at']) ?>, <?= $this->lib->format_time($value['update_at']) ?></td>
                                                        <td align="center">
                                                            <a href="<?= base_url('admin/'.$this->uri->segment(2).'/detail/'.$value['id']) ?>" class="btn btn-warning btn-sm"><i class="uil-eye"></i></a> 
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