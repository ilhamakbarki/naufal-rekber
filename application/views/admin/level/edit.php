                        <div class="row">
                        	<div class="col-sm-12">
                        		<a href="<?= base_url('admin/'.$this->uri->segment(2)) ?>" class="btn btn-warning btn-sm mb-3"><i class="uil-arrow-left"></i> Kembali</a>
                        		<div class="card">
                        		    <div class="card-body">
                            		    <h4 class="card-title mb-4"><i class="uil-arrow-up text-primary"></i> Ubah Level</h4>
                                        <form method="POST">
                                        	<input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />
                                        	<div class="mb-3">
                                        		<label>ID Level</label>
                                        		<input type="number" class="form-control" name="level" value="<?= $target->level ?>" readonly>
                                        		<span class="text-danger"><?php echo form_error('level'); ?></span>
                                        	</div>
                                        	<div class="mb-3">
                                        		<label>Nama Level</label>
                                        		<input type="text" class="form-control" name="level_name" value="<?= $target->level_name ?>">
                                        		<span class="text-danger"><?php echo form_error('level_name'); ?></span>
                                        	</div>
                                        	<button type="reset" class="btn btn-danger">Ulangi</button>
                                        	<button type="submit" class="btn btn-success">Ubah</button>
                                        </form>
                        		    </div>
                        		</div>
                        	</div>
                        </div>