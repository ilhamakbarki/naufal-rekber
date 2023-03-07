                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <form method="POST" onsubmit="return submitForm(this);">
                                            <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />
                                            <div class="form-group">
                                                <label>Kategori</label>
                                                <select class="form-control custom-select" name="category">
                                        			<option value="0" selected="" disabled="">Pilih Salah Satu</option>
                                                    <?php
                                                    foreach ($category as $key => $value) {
                                                    ?>

                                                    <option value="<?= $value['category_name'] ?>" <?= (set_value('category_name') == $value['category_name']) ? 'selected' : '' ?>><?= $value['category_name'] ?></option>
                                                    <?php } ?>

                                                </select>
                                                <span class="text-danger"><?php echo form_error('category'); ?></span>
                                            </div>
                                            <div class="form-group">
                                                <label>Nama Produk</label>
                                                <input type="text" class="form-control" name="product" placeholder="Masukan Nama Produk" value="<?= set_value('product') ?>">
                                                <span class="text-danger"><?php echo form_error('product'); ?></span>
                                            </div>
                                            <div class="form-group">
                                                <label>Nama Penjual</label>
                                                <input type="text" class="form-control" name="seller_name" placeholder="Masukan Nama Penjual" value="<?= set_value('seller_name') ?>">
                                                <span class="text-danger"><?php echo form_error('seller_name'); ?></span>
                                            </div>
                                            <div class="form-group">
                                                <label>Nama Pembeli</label>
                                                <input type="text" class="form-control" name="buyyer_name" placeholder="Masukan Nama Pembeli" value="<?= set_value('buyyer_name') ?>">
                                                <span class="text-danger"><?php echo form_error('buyyer_name'); ?></span>
                                            </div>
                                            <div class="form-group">
                                                <label>Harga</label>
                                                <input type="text" class="form-control" name="amount" id="amount" placeholder="Minimal transaksi 10.000 rupiah" value="<?= set_value('amount') ?>">
                                                <span class="text-danger"><?php echo form_error('amount'); ?></span>
                                            </div>
                                            <div class="form-group">
                                                <label>Fee</label>
                                                <span class="form-control" id="fee">Rp 0</span>
                                                <span class="text-danger"><?php echo form_error('fee'); ?></span>
                                            </div>
                                            <div class="form-group">
                                                <label>Rekening Penjual</label>
                                                <span class="form-control mp" id="rekening" data-toggle="modal" data-target="#paymentModal"><?= set_value('rekening') ?></span>
                                                <span class="text-danger"><?php echo form_error('method'); ?></span><br>
                                                <span class="text-danger"><?php echo form_error('rekening'); ?></span>
                                            </div>
                                            <!-- Modal -->
                                            <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="paymentModalLabel">Metode Pencairan</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group text-left">
                                                                <label class="col-form-label">Rekening</label>
                                                                <input type="number" class="form-control" name="rekening" id="modalRekening" placeholder="Masukan nomor rekening anda" value="<?= set_value('rekening') ?>">
                                                                <span class="text-danger"><?php echo form_error('rekening'); ?></span>
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
                                                                                <input type="radio" name="method" id="method" value="<?= $value['payment_method_name'] ?>">
                                                                            </label>
                                                                        </div>
                                                                        <?php } ?>
                                                                        
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <span class="text-danger"><?php echo form_error('method'); ?></span>
                                                                        </div>
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
                                                                                <input type="radio" name="method" id="method" value="<?= $value['payment_method_name'] ?>">
                                                                            </label>
                                                                        </div>
                                                                        <?php } ?>
                                                                        
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <span class="text-danger"><?php echo form_error('method'); ?></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-warning" data-dismiss="modal">Tutup</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label>Biaya admin ditanggung oleh</label>
                                                <div class="custom-control custom-radio mb-2">
                                                    <input type="radio" id="buyyer" name="fee_by" value="Pembeli" class="custom-control-input" <?= (set_value('fee_by') == 'Pembeli') ? 'checked' : '' ?>>
                                                    <label class="custom-control-label" for="buyyer">Pembeli</label>
                                                </div>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="seller" name="fee_by" value="Penjual" class="custom-control-input" <?= (set_value('fee_by') == 'Penjual') ? 'checked' : '' ?>>
                                                    <label class="custom-control-label" for="seller">Penjual</label>
                                                </div>
                                                <span class="text-danger"><?php echo form_error('fee_by'); ?></span>
                                            </div>
                                            <div class="row">
                                                <div class="offset-lg-3 col-lg-6">
                                                    <button type="submit" class="btn btn-primary btn-block rounded-pill alert">Buat Transaksi</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <script type="text/javascript">
                            function submitForm() {
                              return confirm('Apakah anda ingin membuat transaksi?');
                            }
                            $(document).ready(function() {
                                $('#amount').mask('000.000.000', {reverse: true});
                            });
                            $(".payment-method").on("click", function(){
                                $(".payment-method.active").removeClass("active");
                                $(this).addClass("active");
                            });
                            $(function() {
                            	$('#modalRekening').on('keyup', function() {
                            		var modalRekening = $('#modalRekening').val();
                            		$('#rekening').html(modalRekening);
                            	});
                                $('input[name="method"]').on("click", function() {
                                    var method = $('input[type=radio][name=method]:checked').val();
                                    if (method == 'BCA') {
                                        $('.mp').addClass('mp-bca');
                                        $(".mp").removeClass('mp-bni');
                                        $(".mp").removeClass('mp-bri');
                                        $(".mp").removeClass('mp-mandiri');
                                        $(".mp").removeClass('mp-gopay');
                                        $(".mp").removeClass('mp-dana');
                                        $(".mp").removeClass('mp-ovo');
                                    } else if (method == 'BNI') {
                                        $('.mp').addClass('mp-bni');
                                        $(".mp").removeClass('mp-bca');
                                        $(".mp").removeClass('mp-bri');
                                        $(".mp").removeClass('mp-mandiri');
                                        $(".mp").removeClass('mp-gopay');
                                        $(".mp").removeClass('mp-dana');
                                        $(".mp").removeClass('mp-ovo');
                                    } else if (method == 'BRI') {
                                        $('.mp').addClass('mp-bri');
                                        $(".mp").removeClass('mp-bca');
                                        $(".mp").removeClass('mp-bni');
                                        $(".mp").removeClass('mp-mandiri');
                                        $(".mp").removeClass('mp-gopay');
                                        $(".mp").removeClass('mp-dana');
                                        $(".mp").removeClass('mp-ovo');
                                    } else if (method == 'MANDIRI') {
                                        $('.mp').addClass('mp-mandiri');
                                        $(".mp").removeClass('mp-bca');
                                        $(".mp").removeClass('mp-bni');
                                        $(".mp").removeClass('mp-bri');
                                        $(".mp").removeClass('mp-gopay');
                                        $(".mp").removeClass('mp-dana');
                                        $(".mp").removeClass('mp-ovo');
                                    } else if (method == 'GOPAY') {
                                        $('.mp').addClass('mp-gopay');
                                        $(".mp").removeClass('mp-bca');
                                        $(".mp").removeClass('mp-bni');
                                        $(".mp").removeClass('mp-bri');
                                        $(".mp").removeClass('mp-mandiri');
                                        $(".mp").removeClass('mp-dana');
                                        $(".mp").removeClass('mp-ovo');
                                    } else if (method == 'DANA') {
                                        $('.mp').addClass('mp-dana');
                                        $(".mp").removeClass('mp-bca');
                                        $(".mp").removeClass('mp-bni');
                                        $(".mp").removeClass('mp-bri');
                                        $(".mp").removeClass('mp-mandiri');
                                        $(".mp").removeClass('mp-gopay');
                                        $(".mp").removeClass('mp-ovo');
                                    } else if (method == 'OVO') {
                                        $('.mp').addClass('mp-ovo');
                                        $(".mp").removeClass('mp-bca');
                                        $(".mp").removeClass('mp-bni');
                                        $(".mp").removeClass('mp-bri');
                                        $(".mp").removeClass('mp-mandiri');
                                        $(".mp").removeClass('mp-gopay');
                                        $(".mp").removeClass('mp-dana');
                                    } else {
                                        $(".mp").removeClass('mp-bca');
                                        $(".mp").removeClass('mp-bni');
                                        $(".mp").removeClass('mp-bri');
                                        $(".mp").removeClass('mp-mandiri');
                                        $(".mp").removeClass('mp-gopay');
                                        $(".mp").removeClass('mp-dana');
                                        $(".mp").removeClass('mp-ovo');
                                    }
                                    console.log(method);
                                });
                            	$('#amount').on('keyup', function() {
                            		var amount = $('#amount').val();
                            		$.ajax({
                            			type: "GET",
                            			url: "<?= base_url('ajax/get_fee') ?>?<?= $this->security->get_csrf_token_name() ?>=<?= $this->security->get_csrf_hash() ?>&amount=" + amount,
                            			dataType: "json",
                            			success: function(data) {
                            				$('#fee').html(data.fee);
                            			}, error: function() {
                            				$('#fee').html('Rp 0');
                            			}
                            		});
                            	});
                            });
                        </script>