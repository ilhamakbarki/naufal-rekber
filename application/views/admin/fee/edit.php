                        <div class="row">
                        	<div class="col-sm-12">
                        		<a href="<?= base_url('admin/'.$this->uri->segment(2)) ?>" class="btn btn-warning btn-sm mb-3"><i class="uil-arrow-left"></i> Kembali</a>
                        		<div class="card">
                        		    <div class="card-body">
                            		    <h4 class="card-title mb-4"><i class="uil-dollar-sign text-primary"></i> Ubah Fee</h4>
                                        <form method="POST">
                                        	<input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />
                                        	<div class="mb-3">
                                        		<label>Fee Mulai Dari</label>
                                        		<input type="text" class="form-control" name="from" value="<?= $target->from ?>">
                                        		<span class="text-danger"><?php echo form_error('from'); ?></span>
                                        	</div>
                                        	<div class="mb-3">
                                        		<label>Fee Sampai Ke</label>
                                        		<input type="text" class="form-control" name="to" value="<?= $target->to ?>">
                                        		<span class="text-danger"><?php echo form_error('to'); ?></span>
                                        	</div>
                                        	<div class="mb-3">
                                        		<label>Fee</label>
                                        		<input type="number" class="form-control" name="fee" value="<?= $target->fee ?>">
                                        		<span class="text-danger"><?php echo form_error('fee'); ?></span>
                                        	</div>
                                        	<button type="reset" class="btn btn-danger">Ulangi</button>
                                        	<button type="submit" class="btn btn-success">Ubah</button>
                                        </form>
                        		    </div>
                        		</div>
                        	</div>
                        </div>