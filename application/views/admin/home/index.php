                        <div class="row">
                            <div class="col-md-12 col-xl-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="float-end mt-2">
                                            <h1><i class="uil-users-alt text-success"></i></h1>
                                        </div>
                                        <div>
                                            <h4 class="mb-1 mt-1"><span><?= number_format($widget['user'][0]['total'],0,',','.') ?></span></h4>
                                            </br>
                                            <p class="text-muted mb-0">Total Users</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 col-xl-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="float-end mt-2">
                                            <h1><i class="uil-shopping-cart-alt text-primary"></i></h1>
                                        </div>
                                        <div>
                                            <h4 class="mb-1 mt-1">Rp <span><?= number_format($widget['order'][0]['rupiah'],0,',','.') ?> </br>(Dari <?= number_format($widget['order'][0]['total'],0,',','.') ?> Transaksi Success)</span></h4>
                                            <p class="text-muted mb-0">Total Transaksi</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 col-xl-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="float-end mt-2">
                                            <h1><i class="uil-dollar-sign text-warning"></i></h1>
                                        </div>
                                        <div>
                                            <h4 class="mb-1 mt-1">Rp <span><?= number_format($widget['fee'][0]['rupiah'],0,',','.') ?></span></h4>
                                            <br>
                                            <p class="text-muted mb-0">Pendapatan Fee</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>