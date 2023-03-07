                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="font-size-16 mt-0 d-flex"><a href="<?= base_url() ?>order/detail/<?= $order->order_id ?>" class="mr-2"><i class="las la-arrow-left fs-2"></i></a> <?= $user->full_name ?></h4>
                                        <div class="kk-chat-content">
                                            <?php
                                            if ($order->order_by == 'Pembeli') {
                                            foreach ($target as $key => $value) {
                                            if ($value['sender'] == 'Penjual') {
                                                $position = 'right';
                                                $sender = '';
                                                $style = ' style="border: none; background-color: #d9dde0;"';
                                            } else if ($value['sender'] == 'Pembeli') {
                                                $position = 'left';
                                                $sender = '';
                                                $style = '';
                                            } else if ($value['sender'] == 'Admin') {
                                                $position = 'center';
                                                $sender = 'Admin';
                                                $style = '';
                                            }
                                            $message = htmlentities(str_replace('\r\n', '<br />', $value['message']), ENT_QUOTES);
                                            ?>
                                        
                                            <div class="kk-chat-content-<?= $position; ?>">
                                                <div class="kk-chat-content-message-<?= $position; ?>"<?= $style; ?>>
                                                    <?= str_replace('\n', '<br>', $message) ?>

                                                </div>
                                                <span class="kk-chat-content-date-time-<?= $position; ?>"><b><?= $sender; ?></b> <?= $this->lib->format_time($value['created_at']) ?></span>
                                            </div>
                                            <?php
                                            }
                                            } else if ($order->order_by == 'Penjual') {
                                            foreach ($target as $key => $value) {
                                            if ($value['sender'] == 'Pembeli') {
                                                $position = 'right';
                                                $sender = '';
                                                $style = ' style="border: none; background-color: #d9dde0;"';
                                            } else if ($value['sender'] == 'Penjual') {
                                                $position = 'left';
                                                $sender = '';
                                                $style = '';
                                            } else if ($value['sender'] == 'Admin') {
                                                $position = 'center';
                                                $sender = 'Admin';
                                                $style = '';
                                            }
                                            $message = htmlentities(str_replace('\r\n', '<br />', $value['message']), ENT_QUOTES);
                                            ?>
                                            
                                            <div class="kk-chat-content-<?= $position; ?>">
                                                <div class="kk-chat-content-message-<?= $position; ?>"<?= $style; ?>>
                                                    <?= str_replace('\n', '<br>', $message) ?>

                                                </div>
                                                <span class="kk-chat-content-date-time-<?= $position; ?>"><b><?= $sender; ?></b> <?= $this->lib->format_time($value['created_at']) ?></span>
                                            </div>
                                            <?php } } ?>
                                            
                                        </div>
                                        <form method="POST" >
                                            <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />
                                            <div class="form-group pt-3">
                                                <div class="input-group">
                                                    <textarea type="text" class="form-control" name="message" placeholder="Ketik pesan kamu disini" rows="1"><?= htmlentities(set_value('message'), ENT_QUOTES) ?></textarea>
                                                    <div class="input-group-append">
                                                        <button type="submit" class="btn btn-primary"><i class="lab la-telegram-plane"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>