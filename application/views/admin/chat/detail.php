                        <div class="row">
                        	<div class="offset-lg-2 col-lg-8">
                        	    <a href="<?= base_url('admin/'.$this->uri->segment(2)) ?>" class="btn btn-warning btn-sm mb-3"><i class="uil-arrow-left"></i> Kembali</a>
                        		<div class="card">
                        		    <div class="card-body">
                        		        <h4 class="card-title mb-4"><i class="uil-comment text-primary"></i> Chat #<?= $target->order_id ?></h4>
                                        <div>
                                            <?php
                                            foreach ($chat as $key => $value) {
                                            if ($value['sender'] == 'Pembeli') {
                                                $style = ' text-align: right;';
                                            } else {
                                                $style = '';
                                            }
                                            $message = htmlentities(str_replace('\r\n', '<br />', $value['message']), ENT_QUOTES);
                                            ?>

                                            <div class="alert alert-info" style="color: #000;<?= $style ?>">
                                            	<p style="margin-bottom: 15px;"><?= str_replace('\n', '<br>', $message) ?></p>
                                            	<b><?= $value['sender'] ?></b>
                                            	<span><?= $this->lib->format_time($value['created_at']) ?></span>
                                            </div>
                                            <?php } ?>

                                        </div>
                                        <form method="POST">
                                        	<input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />
                                        	<div class="mb-3">
                                        		<label>Pesan</label>
                                        		<textarea class="form-control" name="message" rows="3"></textarea>
                                        	</div>
                                        	<button type="reset" class="btn btn-danger">Ulangi</button>
                                        	<button type="submit" class="btn btn-success">Kirim</button>
                                        </form>
                                    </div>
                        		</div>
                        	</div>
                        </div>