                        <div class="row">
                        	<div class="offset-lg-3 col-lg-6">
                        		<a href="<?= base_url('admin/'.$this->uri->segment(2)) ?>" class="btn btn-warning btn-sm mb-3"><i class="uil-arrow-left"></i> Kembali</a>
                        		<div class="card">
                        		    <div class="card-body">
                            		    <h4 class="card-title mb-4"><i class="uil-credit-card text-primary"></i> Tambah Metode Payment</h4>
                                        <form method="POST" enctype="multipart/form-data">
                                        	<input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />
                                        	<div class="mb-3">
                                        		<label>Kategori</label>
                                        		<div class="form-check">
                                        			<input type="radio" class="form-check-input" id="cat_bank" value="BANK" name="category">
                                        			<label class="form-check-label" for="cat_bank">BANK</label>
                                        		</div>
                                        		<div class="form-check">
                                        			<input type="radio" class="form-check-input" id="cat_e-money" value="E-MONEY" name="category">
                                        			<label class="form-check-label" for="cat_e-money">E-MONEY</label>
                                        		</div>
                                        		<span class="text-danger"><?php echo form_error('category'); ?></span>
                                        	</div>
                                        	<div class="mb-3">
                                        		<label>Metode Payment</label>
                                        		<input type="text" class="form-control" name="payment_method_name" value="<?= set_value('payment_method_name') ?>">
                                        		<span class="text-danger"><?php echo form_error('payment_method_name'); ?></span>
                                        	</div>
                                        	<div class="mb-3">
                                        		<label>Fee</label>
                                        		<input type="number" class="form-control" name="fee" value="<?= set_value('fee') ?>">
                                        		<span class="text-danger"><?php echo form_error('fee'); ?></span>
                                        	</div>
                                        	<div class="mb-3">
                                        	    <label>Gambar</label>
                                            	<input type="file" class="form-control" name="image">
                                        	</div>
                                        	<button type="reset" class="btn btn-danger">Ulangi</button>
                                        	<button type="submit" class="btn btn-success">Tambah</button>
                                        </form>
                        		    </div>
                        		</div>
                        	</div>
                        </div>