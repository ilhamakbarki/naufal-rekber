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
                        			                <th>Total Yang Didapatkan</th>
                        			                <td>Rp <?= number_format($get_amount,0,',','.') ?></td>
                        			            </tr>
                        			            <tr>
                        			                <td align="center" colspan="2">
                        			                    <div class="row">
                        			                        <div class="col-md-4">
                                			                    <form method="POST" onsubmit="return cancelTransaction(this);">
                                                                    <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />
                                			                        <button type="submit" name="action" value="cancel" class="btn btn-warning btn-block rounded-pill"<?= ($target->status == 'Menunggu Pembeli') ? '' : ' disabled' ?>>Batalkan Transaksi</button>
                                			                    </form>
                        			                        </div>
                        			                        <div class="col-md-4">
                                			                    <form method="POST" onsubmit="return confirmTransaction(this);">
                                                                    <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />
                                			                        <button type="submit" name="action" value="confirmation" class="btn btn-success btn-block rounded-pill"<?= ($target->status == 'Pesanan Belum Dikirim') ? '' : ' disabled' ?>>Konfirmasi Pesanan Telah Dikirim</button>
                                			                    </form>
                        			                        </div>
                        			                        <div class="col-md-4">
                        			                            <a href="<?= base_url() ?>order/chat_seller/<?= $target->order_id ?>" class="btn btn-outline-primary btn-block rounded-pill<?= ($target->status == 'Canceled') ? ' disabled' : '' ?>"><i class="las la-comment fs-18"></i></a>
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

                        <script>
                            function cancelTransaction() {
                              return confirm('Apakah anda yakin untuk membatalkan transaksi?');
                            }
                            function confirmTransaction() {
                              return confirm('Apakah anda ingin mengkonfirmasi transaksi?');
                            }
                        </script>