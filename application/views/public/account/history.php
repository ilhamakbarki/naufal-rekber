                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table kk-order">
                                                <tbody>
                                                    <?php
                                                    if ($order_count > 0) {
                                                    foreach ($table as $key => $value) {
                                                    ?>
                    
                                                    <tr class="kk-order-dekstop">
                                                        <td><span class="badge badge-info"><?= $value['order_id'] ?></span></td>
                                                        <td>
                                                            <div class="kk-order-product-name"><?= $value['category_name'] ?></div>
                                                            <div class="kk-order-date-time"><?= $this->lib->format_date($value['created_at']) ?>, <?= $this->lib->format_time($value['created_at']) ?> - <?= $this->lib->format_date($value['update_at']) ?>, <?= $this->lib->format_time($value['update_at']) ?></div>
                                                        </td>
                                                        <td><input type="text" class="form-control" value="<?= $value['order_name'] ?>" readonly></td>
                                                        <td>
                                                            <div class="kk-order-price">Rp <?= number_format($value['amount'],0,',','.') ?></div>
                                                        </td>
                                                        <td><div class="kk-order-status-<?= $this->lib->status_order($value['status']) ?>"><?= $value['status'] ?></div></td>
                                                        <td><a href="<?= base_url('order/detail/').$value['order_id'] ?>"></a></td>
                                                    </tr>
                                                    <tr class="kk-order-mobile">
                                                        <td><span class="badge badge-info"><?= $value['order_id'] ?></span></td>
                                                        <td>
                                                            <div class="kk-order-product-name"><?= $value['category_name'] ?></div>
                                                            <div class="kk-order-target"><?= $value['order_name'] ?></div>
                                                        </td>
                                                        <td>
                                                            <div class="kk-order-price">Rp <?= number_format($value['amount'],0,',','.') ?></div>
                                                        </td>
                                                        <td>
                                                            <div class="kk-order-date-time"><?= $this->lib->format_date($value['created_at']) ?> - <?= $this->lib->format_date($value['update_at']) ?></div>
                                                            <div class="kk-order-status-<?= $this->lib->status_order($value['status']) ?>"><?= $value['status'] ?></div>
                                                        </td>
                                                        <td><a href="<?= base_url('order/detail/').$value['order_id'] ?>"></a></td>
                                                    </tr>
                                                    <?php } } else { ?>
                    
                                        			<td colspan="5" class="text-center">Data kamu masih kosong</td>
                                        			<?php } ?>
                    
                                                </tbody>
                                            </table>
                                            <div>
                                                <ul class="pagination pagination-split">
                                                    <?= $this->pagination->create_links() ?>
                        
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>