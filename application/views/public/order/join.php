                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <form method="POST">
                                            <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />
                                            <div class="form-group">
                                            <div class="form-group">
                                                <label>Kode Transaksi</label>
                                                <input type="text" class="form-control" name="order_id" placeholder="Dapatkan kode transaksi dari penjual">
                                                <span class="text-danger"><?php echo form_error('order_id'); ?></span>
                                            </div>
                                            <div class="row">
                                                <div class="offset-lg-3 col-lg-6">
                                                    <button type="submit" class="btn btn-primary btn-block rounded-pill">Join Transaksi</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>