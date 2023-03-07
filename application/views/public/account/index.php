                    <div class="row">
                        <div class="col-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="text-center mt-3">
                                        <?php if (user('image') == 'male.png') { ?>
                                        
                                        <img src="<?= base_url() ?>assets/images/male.png" alt="Profile" class="avatar-lg rounded-circle" />
                                        <?php } else { ?>
                                        
                                        <img src="<?= base_url() ?>assets/images/profile/<?= user('image') ?>" alt="Profile" class="avatar-lg rounded-circle" />
                                        <?php } ?>
                                        
                                        <h5 class="mt-3 mb-3"><?= user('full_name') ?></h5>
                                    </div>
                                    <div class="mt-3 pt-2 border-top">
                                        <div class="table-responsive">
                                            <table class="table table-borderless mb-2 text-muted">
                                                <tbody>
                                                    <tr>
                                                        <th scope="row">Username</th>
                                                        <td><?= user('username') ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Email</th>
                                                        <td><?= user('email') ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Nomor HP</th>
                                                        <td><?= user('phone') ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="card">
                                <div class="card-body">
                                    <ul class="nav nav-pills navtab-bg nav-justified" id="pills-tab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="true">
                                                Ubah Data Diri
                                            </a>
                                        </li>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="pills-tabContent">
                                        <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                            <form method="POST" enctype="multipart/form-data">
                                                <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />
                                                <div class="form-group">
                                                    <label>Foto Profil</label>
                                                    <input type="file" class="form-control" name="image">
                                                    <input type="hidden" name="old_image" value="<?= user('image') ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Nama Lengkap</label>
                                                    <input type="text" class="form-control" name="full_name" placeholder="Masukan Nama Lengkap" value="<?= user('full_name') ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Username</label>
                                                    <input type="text" class="form-control" name="username" placeholder="Masukan Username" value="<?= user('username') ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="email" class="form-control" name="email" placeholder="Masukan Email" value="<?= user('email') ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Nomor HP</label>
                                                    <input type="number" class="form-control" name="phone" placeholder="Masukan Nomor HP" value="<?= user('phone') ?>">
                                                </div>
                                                <button type="submit" class="btn btn-primary btn-block">Simpan Perubahan</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>