                        			    <form method="POST" action="<?= base_url('admin/'.$this->uri->segment(2).'/edit/'.$target->id) ?>">
                                        	<input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />
                                        	<div class="mb-3">
                                        		<label class="form-label">Kode Transaksi</label>
                                        		<input type="text" class="form-control" value="<?= $target->order_id ?>" readonly>
                                        	</div>
                                        	<div class="mb-3">
                                        		<label class="form-label">Penjual</label>
                                        		<input type="text" class="form-control" value="<?= $target->seller_name ?>" readonly>
                                        	</div>
                                        	<div class="mb-3">
                                        		<label class="form-label">Pembeli</label>
                                        		<input type="text" class="form-control" value="<?= $target->buyyer_name ?>" readonly>
                                        	</div>
                                        	<div class="mb-3">
                                        		<label class="form-label">Status</label>
                                        		<select class="form-select" name="status">
                                        			<option value="Refund Pending" <?= ($target->status == 'Refund Pending') ? 'selected' : '' ?>>Refund Pending</option>
                                        			<option value="Refund Success" <?= ($target->status == 'Refund Success') ? 'selected' : '' ?>>Refund Success</option>
                                        			<option value="Refund Cancel" <?= ($target->status == 'Refund Cancel') ? 'selected' : '' ?>>Refund Cancel</option>
                                        		</select>
                                        	</div>
                                        	<button type="reset" class="btn btn-danger">Ulangi</button>
                                        	<button type="submit" class="btn btn-success">Ubah</button>
                                        </form>