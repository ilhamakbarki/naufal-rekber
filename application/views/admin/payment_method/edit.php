                        <div class="row">
                        	<div class="offset-lg-3 col-lg-6">
                        		<a href="<?= base_url('admin/'.$this->uri->segment(2)) ?>" class="btn btn-warning btn-sm mb-3"><i class="uil-arrow-left"></i> Kembali</a>
                        		<div class="card">
                        		    <div class="card-body">
                            		    <h4 class="card-title mb-4"><i class="uil-credit-card text-primary"></i> Ubah Metode Payment</h4>
                                        <form method="POST" enctype="multipart/form-data">
                                        	<input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />
                                        	<input type="hidden" name="old_image" value="<?= $target->image ?>">
                                        	<div class="mb-3">
                                        		<label>Kategori</label>
                                        		<div class="form-check">
                                        			<input type="radio" class="form-check-input" id="cat_bank" value="BANK" name="category" <?= ($target->category == 'BANK') ? 'checked' : '' ?>>
                                        			<label class="form-check-label" for="cat_bank">BANK</label>
                                        		</div>
                                        		<div class="form-check">
                                        			<input type="radio" class="form-check-input" id="cat_e-money" value="E-MONEY" name="category" <?= ($target->category == 'E-MONEY') ? 'checked' : '' ?>>
                                        			<label class="form-check-label" for="cat_e-money">E-MONEY</label>
                                        		</div>
                                        		<span class="text-danger"><?php echo form_error('category'); ?></span>
                                        	</div>
                                        	<div class="mb-3">
                                        		<label>Metode Payment</label>
                                        		<input type="text" class="form-control" name="payment_method_name" value="<?= $target->payment_method_name ?>">
                                        		<span class="text-danger"><?php echo form_error('payment_method_name'); ?></span>
                                        	</div>
                                        	<div class="mb-3">
                                        		<label>Fee</label>
                                        		<input type="number" class="form-control" name="fee" value="<?= $target->fee ?>">
                                        		<span class="text-danger"><?php echo form_error('fee'); ?></span>
                                        	</div>
                                        	<div class="mb-3">
                                        	    <label>Gambar</label>
                                            	<input type="file" class="form-control" name="image">
                                            	<i class='text-danger'>Lihat Gambar Saat ini :</i> <a href="<?= base_url() ?>assets/images/payment/<?= $target->image ?>" target="_blank"><?= $target->image ?></a>
                                        	</div>
                                        	<div class="mb-3">
                                        		<label>Status</label>
                                        		<div class="form-check">
                                        			<input type="radio" class="form-check-input" id="active" value="1" name="status" <?= ($target->status == '1') ? 'checked' : '' ?>>
                                        			<label class="form-check-label" for="active">Aktif</label>
                                        		</div>
                                        		<div class="form-check">
                                        			<input type="radio" class="form-check-input" id="not_active" value="0" name="status" <?= ($target->status == '0') ? 'checked' : '' ?>>
                                        			<label class="form-check-label" for="not_active">Tidak Aktif</label>
                                        		</div>
                                        		<span class="text-danger"><?php echo form_error('status'); ?></span>
                                        	</div>
                                        	<button type="reset" class="btn btn-danger">Ulangi</button>
                                        	<button type="submit" class="btn btn-success">Ubah</button>
                                        </form>
                            		</div>
                        		</div>
                        	</div>
                        </div>