                <div class="row justify-content-center">
                    <div class="col-xl-10">
                        <div class="card">
                            <div class="card-body p-0">
                                <div class="row">
                                    <div class="col-lg-6 p-5">
                                        <div class="mx-auto mb-5">
                                            <a href="<?= base_url() ?>">
                                                <img src="<?= base_url() ?>assets/images/logo1.jpg" alt="" height="50"/>
                                                <h3 class="d-inline align-middle ml-1 text-logo"><?= $config['short_title'] ?></h3>
                                            </a>
                                        </div>
                                        <h6 class="h4 mb-0 mt-4">Daftar Akun</h6>
                                        <p class="text-muted mt-0 mb-4">Buat akun gratis dan mulai gunakan <?= $config['short_title'] ?></p>
                                        <div class="row">
                                            <div class="col-sm-12"><?php $this->load->view('result') ?></div>
                                        </div>
                                        <form method="POST" class="authentication-form">
                                            <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />
                                            <div class="form-group">
                                                <label class="form-control-label">Nama Lengkap</label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="icon-dual" data-feather="user"></i>
                                                        </span>
                                                    </div>
                                                    <input type="text" class="form-control" name="full_name" placeholder="Nama Lengkap" value="<?= set_value('full_name') ?>">
                                                </div>
                                                <span class="text-danger"><?php echo form_error('full_name'); ?></span>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label">Username</label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="icon-dual" data-feather="user"></i>
                                                        </span>
                                                    </div>
                                                    <input type="text" class="form-control" name="username" placeholder="Username" value="<?= set_value('username') ?>">
                                                </div>
                                                <span class="text-danger"><?php echo form_error('username'); ?></span>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label">Email</label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="icon-dual" data-feather="mail"></i>
                                                        </span>
                                                    </div>
                                                    <input type="email" class="form-control" name="email" placeholder="Email" value="<?= set_value('email') ?>">
                                                </div>
                                                <span class="text-danger"><?php echo form_error('email'); ?></span>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label">Nomor HP</label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="icon-dual" data-feather="phone"></i>
                                                        </span>
                                                    </div>
                                                    <input type="number" class="form-control" name="phone" placeholder="Nomor HP" value="<?= set_value('phone') ?>">
                                                </div>
                                                <span class="text-danger"><?php echo form_error('phone'); ?></span>
                                            </div>
                                            <div class="form-group ">
                                                <label class="form-control-label">Password</label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="icon-dual" data-feather="lock"></i>
                                                        </span>
                                                    </div>
                                                    <input type="password" class="form-control" name="password" placeholder="Password" value="<?= set_value('password') ?>">
                                                </div>
                                                <span class="text-danger"><?php echo form_error('password'); ?></span>
                                            </div>
                                            <div class="form-group mb-4">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="terms" id="terms" value="1" checked>
                                                    <label class="custom-control-label" for="terms">
                                                        Saya Setuju Dengan <a href="javascript: void(0);">Ketentuan Layanan</a>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group mb-0 text-center">
                                                <button class="btn btn-primary btn-block" type="submit">Daftar</button>
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