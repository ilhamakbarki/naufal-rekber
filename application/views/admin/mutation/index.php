                        <div class="row">
                        	<div class="col-sm-12">
                        		<div class="card">
                        		    <div class="card-body">
                            		    <h4 class="card-title mb-4"><i class="uil-modem text-primary"></i> Mutasi</h4>
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
                                            			<th>ID MUTASI</th>
                                            			<th>JUMLAH</th>
                                            			<th>BANK</th>
                                            			<th>DESKRIPSI</th>
                                            			<th>INVOICE URL</th>
                                            			<th>STATUS</th>
                                            			<th>TANGGAL&nbsp;&&nbsp;WAKTU&nbsp;DIBUAT</th>
                                            			<th>TANGGAL&nbsp;&&nbsp;WAKTU&nbsp;UPDATE</th>
                                            		</tr>
                                            	</thead>
                                            	<tbody>
                                                    <?php
                                                    foreach ($table as $key => $value) {
                                                    ?>
    
                                        			<tr>
                                        				<td><?= $value['id'] ?></td>
                                        				<td><?= $value['order_id'] ?></td>
                                        				<td><?= $value['mutation_id'] ?></td>
                                        				<td>Rp <?= number_format($value['amount'],0,',','.') ?></td>
                                        				<td><?= $value['bank'] ?></td>
                                        				<td><?= $value['description'] ?></td>
                                        				<td><a href="<?= $value['invoice_url'] ?>" target="blank"><?= $value['invoice_url'] ?></a></td>
                                        				<td><span class="badge badge-<?= $status[$value['status']]['color'] ?>"><?= $value['status'] ?></span></td>
                                        				<td><?= $this->lib->format_date($value['created_at']) ?>, <?= $this->lib->format_time($value['created_at']) ?></td>
                                        				<td><?= $this->lib->format_date($value['update_at']) ?>, <?= $this->lib->format_time($value['update_at']) ?></td>
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