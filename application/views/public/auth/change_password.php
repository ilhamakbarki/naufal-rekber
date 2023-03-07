                <div class="row justify-content-center">
                    <div class="col-xl-10">
                        <div class="card">
                            <div class="card-body p-0">
                                <div class="row">
                                    <div class="col-md-6 p-5">
                                        <div class="mx-auto mb-5">
                                            <a href="<?= base_url() ?>">
                                                <img src="<?= base_url() ?>assets/images/logo1.jpg" alt="" height="50"/>
                                                <h3 class="d-inline align-middle ml-1 text-logo"><?= $config['short_title'] ?></h3>
                                            </a>
                                        </div>
                                        <h6 class="h4 mb-0 mt-4">Lupa password!</h6>
                                        <p class="text-muted mt-1 mb-4">Ganti password sekarang untuk melakukan aktifitas lagi di <?= $config['short_title'] ?></p>
                                        <div class="row">
                                            <div class="col-sm-12"><?php $this->load->view('result') ?></div>
                                        </div>
                                        <form method="POST" class="authentication-form">
                                            <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />
                                            <div class="form-group">
                                                <label class="form-control-label">Password Baru</label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="icon-dual" data-feather="lock"></i>
                                                        </span>
                                                    </div>
                                                    <input type="password" class="form-control" name="new_password" placeholder="Password Baru" value="<?= set_value('new_password') ?>">
                                                </div>
                                                <span class="text-danger"><?php echo form_error('new_password'); ?></span>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label">Konfirmasi Password Baru</label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="icon-dual" data-feather="lock"></i>
                                                        </span>
                                                    </div>
                                                    <input type="password" class="form-control" name="confirm_new_password" placeholder="Konfirmasi Password Baru" value="<?= set_value('confirm_new_password') ?>">
                                                </div>
                                                <span class="text-danger"><?php echo form_error('confirm_new_password'); ?></span>
                                            </div>
                                            <div class="form-group mb-0 text-center">
                                                <button class="btn btn-primary btn-block" type="submit">Ganti Password</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-lg-6 d-none d-md-inline-block">
                                        <div class="auth-page-sidebar d-flex align-items-center">
                                            <img class="img-fluid" src="<?= base_url('assets/images/logo2.jpg') ?>" alt="Logo">
                                            <div class="overlay"></div>
                                            <div class="auth-user-testimonial"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 text-center">
                                <p class="text-muted">Sudah punya akun? <a href="<?= base_url('auth/login') ?>" class="text-primary font-weight-bold ml-1">Masuk</a></p>
                            </div>
                        </div>
                    </div>
                </div>