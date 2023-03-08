                        <div class="row">
                        	<div class="col-lg-12">
                        		<div class="card">
                        		    <div class="card-body">
                        		        <h4 class="card-title mb-4"><i class="uil-shopping-cart-alt text-primary"></i> Daftar Transaksi</h4>
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
                                        <form method="POST" action="<?= base_url('admin/'.$this->uri->segment(2).'/filter') ?>">
                                            <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />
                                            <div class="row">
                                        	    <div class="col-md-4">
                                        	        <div class="mb-3">
                                        			    <div class="d-grid gap-2">
                                        			        <button type="submit" name="action" value="all" class="btn btn-primary">Semua</button>
                                        			    </div>
                                        	        </div>
                                        		</div>
                                        	    <div class="col-md-4">
                                        	        <div class="mb-3">
                                        			    <div class="d-grid gap-2">
                                        			        <button type="submit" name="action" value="success" class="btn btn-success">Success</button>
                                        			    </div>
                                        	        </div>
                                        		</div>
                                        	    <div class="col-md-4">
                                        	        <div class="mb-3">
                                        			    <div class="d-grid gap-2">
                                        			        <button type="submit" name="action" value="refund" class="btn btn-danger">Refund</button>
                                        			    </div>
                                        	        </div>
                                        		</div>
                                        	</div>
                                        </form>
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                            	<thead>
                                            		<tr>
                                            			<th>KODE&nbsp;TRANSAKSI</th>
                                            			<th>TANGGAL&nbsp;&&nbsp;WAKTU&nbsp;DIBUAT</th>
                                            			<th>TANGGAL&nbsp;&&nbsp;WAKTU&nbsp;UPDATE</th>
                                            			<th>PENJUAL</th>
                                            			<th>PEMBELI</th>
                                            			<th>DIBUAT&nbsp;OLEH</th>
                                            			<th>KATEGORI</th>
                                            			<th>PRODUK</th>
                                            			<th>HARGA</th>
                                            			<th>NOMOR&nbsp;UNIK</th>
                                            			<th>FEE</th>
                                            			<th>TOTAL&nbsp;KESELURUHAN</th>
                                            			<th>FEE OLEH</th>
                                            			<th>STATUS</th>
                                            			<th>AKSI</th>
                                            		</tr>
                                            	</thead>
                                            	<tbody>
                                                    <?php
                                                    foreach ($table as $key => $value) {
                                                    ?>

                                                    <tr>
                                                        <td><?= $value['order_id'] ?></td>
                            		                    <td><?= $this->lib->format_date($value['created_at']) ?>, <?= $this->lib->format_time($value['created_at']) ?></td>
                            		                    <td><?= $this->lib->format_date($value['update_at']) ?>, <?= $this->lib->format_time($value['update_at']) ?></td>
                                                        <td><?= $value['seller_name'] ?></td>
                                                        <td><?= $value['buyyer_name'] ?></td>
                                                        <td><?= $value['username'] ?></td>
                                                        <td><?= $value['category_name'] ?></td>
                                                        <td><?= $value['order_name'] ?></td>
                                                        <td>Rp <?= number_format($value['amount'],0,',','.') ?></td>
                                                        <td><?= number_format($value['amount_unix'],0,',','.') ?></td>
                                                        <td>Rp <?= number_format($value['fee'],0,',','.') ?></td>
                                                        <td>Rp <?= number_format($value['grand_total'],0,',','.') ?></td>
                                                        <td><?= $value['fee_by'] ?></td>
                                                        <td><span class="btn btn-sm btn-<?= $this->lib->status_order($value['status']) ?>"><?= $value['status'] ?></span></td>
                                            			<td align="center">
                                            			    <a href="javascript: void(0);" onclick="detail('<?= base_url('admin/'.$this->uri->segment(2).'/detail/'.$value['id']) ?>')" class="btn btn-info btn-sm"><i class="uil-search"></i></a>
                                            			    <a href="javascript: void(0);" onclick="edit('<?= base_url('admin/'.$this->uri->segment(2).'/edit/'.$value['id']) ?>')" class="btn btn-warning btn-sm"><i class="uil-edit"></i></a>
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

                        <div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
                        	<div class="modal-dialog modal-dialog-centered modal-lg">
                        		<div class="modal-content">
                        			<div class="modal-header">
                        				<h5 class="modal-title text-center"><i class="uil-edit text-primary"></i> Ubah Transaksi</h5>
                        			    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        			</div>
                        			<div class="modal-body" id="modal-edit-body"></div>
                        			<div class="modal-footer">
                        			    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        			</div>
                        		</div>
                        	</div>
                        </div>

                        <script type="text/javascript">
                            function edit(url) {
                            	$.ajax({
                            		type: "GET",
                            		url: url,
                            		beforeSend: function() {
                            			$('#modal-edit-body').html('Sedang memuat...');
                            		},
                            		success: function(result) {
                            			$('#modal-edit-body').html(result);
                            		},
                            		error: function() {
                            			$('#modal-edit-body').html('Terjadi kesalahan.');
                            		}
                            	});
                            	$('#modal-edit').modal("show");
                            }
                        </script>