                        <div class="row">
                        	<div class="offset-lg-3 col-lg-6">
                        		<a href="<?= base_url('admin/'.$this->uri->segment(2)) ?>" class="btn btn-warning btn-sm mb-3"><i class="uil-arrow-left"></i> Kembali</a>
                        		<div class="card">
                        		    <div class="card-body">
                        		        <h4 class="card-title mb-4"><i class="uil-edit text-primary"></i> Ubah Akun</h4>
                                        <form method="POST">
                                        	<input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />
                            				<div class="mb-3">
                                        		<label>Nama Lengkap</label>
                                        		<input type="text" class="form-control" name="full_name" value="<?= $target->full_name ?>">
                                        		<span class="text-danger"><?php echo form_error('full_name'); ?></span>
                                        	</div>
                            				<div class="mb-3">
                                        		<label>Username</label>
                                        		<input type="text" class="form-control" name="username" value="<?= $target->username ?>">
                                        		<span class="text-danger"><?php echo form_error('username'); ?></span>
                                        	</div>
                            				<div class="mb-3">
                                        		<label>Email</label>
                                        		<input type="email" class="form-control" name="email" value="<?= $target->email ?>">
                                        		<span class="text-danger"><?php echo form_error('email'); ?></span>
                                        	</div>
                            				<div class="mb-3">
                                        		<label>Nomor HP</label>
                                        		<input type="number" class="form-control" name="phone" value="<?= $target->phone ?>">
                                        		<span class="text-danger"><?php echo form_error('phone'); ?></span>
                                        	</div>
                            				<div class="mb-3">Level</label>
                                        		<select class="form-select" name="level">
                                        		    <option value="0" selected="" disabled="">- Pilih Salah Satu -</option>
                                        		    <option value="1" <?= ($target->level == '1') ? 'selected' : '' ?>>Member</option>
                                        		    <option value="2" <?= ($target->level == '2') ? 'selected' : '' ?>>Admin</option>
                                        		</select>
                                        		<span class="text-danger"><?php echo form_error('level'); ?></span>
                                        	</div>
                            				<div class="mb-3">
                                        		<label>Password <i class="text-danger" style="font-size: 12px">Isi Jika Diubah</i></label>
                                        		<input type="password" class="form-control" name="password">
                                        		<span class="text-danger"><?php echo form_error('password'); ?></span>
                                        	</div>
                            				<div class="mb-3">
                                        		<label>Status</label>
                                        		<div class="form-check">
                                        			<input type="radio" class="form-check-input" id="on" value="1" name="status" <?= ($target->status == '1') ? 'checked' : '' ?>>
                                        			<label class="form-check-label" for="on">Aktif</label>
                                        		</div>
                                        		<div class="form-check">
                                        			<input type="radio" class="form-check-input" id="off" value="0" name="status" <?= ($target->status == '0') ? 'checked' : '' ?>>
                                        			<label class="form-check-label" for="off">Tidak Aktif</label>
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

                        <script type="text/javascript">
                            function generate_api_key() {
                            	$.ajax({
                            		type: "GET",
                            		url: "<?= base_url('admin/user/generate_api_key') ?>",
                            		success: function(data) {
                            			$('#api_key').val(data);
                            		}
                            	});
                            }
                        </script>