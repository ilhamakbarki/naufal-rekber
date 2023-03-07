                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                        			    <div class="table-responsive">
                        			        <table class="table table-bordered">
                                            	<tr>
                                            		<th>Kategori</th>
                                            		<td><?= $target->category_name ?></td>
                                            	</tr>
                                            	<tr>
                                            		<th>Nama</th>
                                            		<td><?= $target->order_name ?></td>
                                            	</tr>
                                            	<tr>
                                            		<th>Nama Penjual</th>
                                            		<td><?= $target->seller_name ?></td>
                                            	</tr>
                                            	<tr>
                                            		<th>Nama Pembeli</th>
                                            		<td><?= $target->buyyer_name ?></td>
                                            	</tr>
                        			            <tr>
                        			                <th>Harga</th>
                        			                <td>Rp <?= number_format($target->amount,0,',','.') ?></td>
                        			            </tr>
                        			            <tr>
                        			                <th>Fee<?= ($target->fee_by == 'Penjual') ? ' <span class="text-danger">(Dibebankan ke penjual)</span>' : ' <span class="text-danger">(Dibebankan ke pembeli)</span>' ?></th>
                        			                <td>Rp <?= number_format($target->fee,0,',','.') ?></td>
                        			            </tr>
                        			            <tr>
                        			                <th>Biaya Transaksi</th>
                        			                <td>Rp <?= number_format($target->amount_unix,0,',','.') ?></td>
                        			            </tr>
                        			            <tr>
                        			                <th>Total Yang Dibayarkan</th>
                        			                <td>Rp <?= number_format($get_fee,0,',','.') ?></td>
                        			            </tr>
                        			            <tr>
                        			                <th>Bayar Sekarang</th>
                        			                <td><a href="<?= base_url() ?>order/payment/<?= $target->reference_id ?>" class="btn btn-primary<?= ($mutation->status == 'Success') ? ' disabled' : '' ?>">Bayar</a></td>
                        			            </tr>
                        			            <tr>
                        			                <td align="center" colspan="2">
                        			                    <div class="row">
                        			                        <div class="col-md-4">
                                			                    <button type="button" class="btn btn-danger btn-block rounded-pill" data-toggle="modal" data-target="#refundModal"<?= ($target->status == 'Pesanan Telah Dikirim') ? '' : ' disabled' ?>>Pengembalian Dana</button>
                        			                        </div>
                        			                        <div class="col-md-4">
                                			                    <form method="POST" onsubmit="return confirmTransaction(this);">
                                                                    <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />
                                			                        <button type="submit" name="action" value="confirmation" class="btn btn-success btn-block rounded-pill"<?= ($target->status == 'Pesanan Telah Dikirim') ? '' : ' disabled' ?>>Konfirmasi Transaksi</button>
                                			                    </form>
                        			                        </div>
                        			                        <div class="col-md-4">
                        			                            <a href="<?= base_url() ?>order/chat_buyyer/<?= $target->order_id ?>" class="btn btn-outline-primary btn-block rounded-pill<?= ($target->status == 'Canceled') ? ' disabled' : '' ?>"><i class="las la-comment fs-18"></i></a>
                        			                        </div>
                        			                    </div>
                        			                </td>
                        			            </tr>
                                            </table>
                        			    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Modal -->
                        <div class="modal fade" id="refundModal" tabindex="-1" role="dialog" aria-labelledby="refundModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="refundModalLabel">Pengembalian Dana</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="POST" onsubmit="return refundTransaction(this);">
                                        <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />
                                        <div class="modal-body">
                                            <div class="form-group text-left">
                                                <label class="col-form-label">Rekening</label>
                                                <input type="number" class="form-control" name="rekening" placeholder="Masukan nomor rekening anda" value="<?= set_value('rekening') ?>">
                                            </div>
                                            <ul class="nav nav-pills navtab-bg nav-justified" id="pills-tab" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" id="pills-bank-tab" data-toggle="pill" href="#pills-bank" role="tab" aria-controls="pills-bank" aria-selected="true">
                                                        Bank
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="pills-e-money-tab" data-toggle="pill" href="#pills-e-money" role="tab" aria-controls="pills-e-money" aria-selected="false">
                                                        E-money
                                                    </a>
                                                </li>
                                            </ul>
                                            <div class="tab-content" id="pills-tabContent">
                                                <div class="tab-pane fade show active" id="pills-bank" role="tabpanel" aria-labelledby="pills-bank-tab">
                                                    <div class="row">
                                                        <?php
                                                        foreach ($payment_bank as $key => $value) {
                                                        ?>

                                                        <div class="col-md-6" style="width: 50%; margin-bottom: 10px;">
                                                            <label class="payment-method">
                                                                <img src="<?= base_url() ?>assets/images/payment/<?= $value['image'] ?>" alt="Metode" class="img-fluid">
                                                                <input type="radio" name="payment" id="payment" value="<?= $value['payment_method_name'] ?>">
                                                            </label>
                                                        </div>
                                                        <?php } ?>

                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="pills-e-money" role="tabpanel" aria-labelledby="pills-e-money-tab">
                                                    <div class="row">
                                                        <?php
                                                        foreach ($payment_emoney as $key => $value) {
                                                        ?>

                                                        <div class="col-md-6" style="width: 50%; margin-bottom: 10px;">
                                                            <label class="payment-method">
                                                                <img src="<?= base_url() ?>assets/images/payment/<?= $value['image'] ?>" alt="Metode" class="img-fluid">
                                                                <input type="radio" name="payment" id="payment" value="<?= $value['payment_method_name'] ?>">
                                                            </label>
                                                        </div>
                                                        <?php } ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-warning" data-dismiss="modal">Tutup</button>
                                            <button type="submit" name="action" value="refund" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <script>
                            function refundTransaction() {
                              return confirm('Apakah anda ingin pengembalian dana pada transaksi ini?');
                            }
                            function confirmTransaction() {
                              return confirm('Apakah anda ingin mengkonfirmasi transaksi?');
                            }
                            $(".payment-method").on("click", function(){
                                $(".payment-method.active").removeClass("active");
                                $(this).addClass("active");
                            });
                        </script>