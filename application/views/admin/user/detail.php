        			    <div class="table-responsive">
        			        <table class="table table-bordered">
        			            <tr>
        			                <th width="50%">ID</th>
        			                <td colspan="2"><?= $target->id ?></td>
        			            </tr>
                            	<tr>
                            		<th>NAMA&nbsp;LENGKAP</th>
                            		<td colspan="2"><?= $target->full_name ?></td>
                            	</tr>
                            	<tr>
                            		<th>EMAIL</th>
                            		<td colspan="2"><?= $target->email ?></td>
                            	</tr>
                            	<tr>
                            		<th>NOMOR&nbsp;HP</th>
                            		<td colspan="2"><?= $target->no_hp ?></td>
                            	</tr>
        			            <tr>
        			                <th>NAMA&nbsp;PENGGUNA</th>
        			                <td colspan="2"><?= $target->username ?></td>
        			            </tr>
                            	<tr>
                            		<th>PIN</th>
                            		<td colspan="2"><?= $target->pin ?></td>
                            	</tr>
                            	<tr>
                            		<th>SALDO</th>
                            		<td colspan="2">Rp <?= number_format($target->balance,0,',','.') ?></td>
                            	</tr>
                            	<tr>
                            		<th>LEVEL&nbsp;AKUN</th>
                            		<td colspan="2"><span class="badge badge-<?= $level[$target->level]['color'] ?>"><?= $target->level ?></span></td>
                            	</tr>
                            	<tr>
                            		<th>STATUS&nbsp;AKUN</th>
                            		<td colspan="2"><h4><i class="<?= ($target->status == '1') ? 'uil-check-circle text-success' : 'uil-times-circle text-danger' ?>"></i></h4></td>
                            	</tr>
                            	<tr>
                            		<td align="center" colspan="3"><b>VERIFIKASI</b></td>
                            	</tr>
                            	<tr class="table-warning">
                            		<th>EMAIL</th>
                            		<th>NOMOR&nbsp;HP</th>
                            		<th>AKUN</th>
                            	</tr>
                            	<tr class="table-warning">
                            		<td align="center"><h4><i class="<?= ($target->is_verif_email == '1') ? 'uil-check-circle text-success' : 'uil-times-circle text-danger' ?>"></i></h4></td>
                            		<td align="center"><h4><i class="<?= ($target->is_verif_no_hp == '1') ? 'uil-check-circle text-success' : 'uil-times-circle text-danger' ?>"></i></h4></td>
                            		<td align="center"><h4><i class="<?= ($target->is_verif == '1') ? 'uil-check-circle text-success' : 'uil-times-circle text-danger' ?>"></i></h4></td>
                            	</tr>
                            	<?php if (admin('level') == 'Owner') { ?>
                            	
                            	<tr>
                            		<td align="center" colspan="3"><b>ALAMAT</b></td>
                            	</tr>
                            	<tr class="table-primary">
                            		<th>KOTA</th>
                            		<th colspan="3">DETAIL</th>
                            	</tr>
                            	<tr class="table-primary">
                            		<td><?= $target->city ?></td>
                            		<td colspan="3">
                            			<textarea class="form-control" id="note" rows="1" readonly><?= $target->address ?></textarea>
                            		</td>
                            	</tr>
                            	<?php } ?>
                            	
                            	<tr>
                            		<td align="center" colspan="3"><b>TOTAL TRANSAKSI</b></td>
                            	</tr>
                            	<tr class="table-success">
                            		<th>SOSIAL&nbsp;MEDIA</th>
                            		<th>TOP&nbsp;UP</th>
                            		<th>TAGIHAN</th>
                            	</tr>
                            	<tr class="table-success">
                            		<td>Rp <?= number_format($total_trx_sosmed[0]['rupiah'],0,',','.') ?> (<?= number_format($total_trx_sosmed[0]['total'],0,',','.') ?>)</td>
                            		<td>Rp <?= number_format($total_trx_topup[0]['rupiah'],0,',','.') ?> (<?= number_format($total_trx_topup[0]['total'],0,',','.') ?>)</td>
                            		<td>Rp <?= number_format($total_trx_bill[0]['rupiah'],0,',','.') ?> (<?= number_format($total_trx_bill[0]['total'],0,',','.') ?>)</td>
                            	</tr>
                            	<tr>
                            		<td align="center" colspan="3"><b>API</b></td>
                            	</tr>
                            	<tr class="table-info">
                            		<th>STATUS</th>
                            		<th>KEY</th>
                            		<th>STATIS&nbsp;IP</th>
                            	</tr>
                            	<tr class="table-info">
                            		<td><h4><i class="<?= ($target->is_api_status == '1') ? 'uil-check-circle text-success' : 'uil-times-circle text-danger' ?>"></i></h4></td>
                            		<td><input type="text" class="form-control form-control-sm" value="<?= $target->api_key ?>" readonly></td>
                            		<td><?= $target->static_ip ?></td>
                            	</tr>
                            	<?php if (admin('level') == 'Owner') { ?>
                            	
                            	<tr>
                            		<td align="center" colspan="3"><b>NOTIFIKASI</b></td>
                            	</tr>
                            	<tr class="table-info">
                            		<th>LOGIN</th>
                            		<th>ISI&nbsp;SALDO</th>
                            		<th>TRANSFER&nbsp;SALDO</th>
                            	</tr>
                            	<tr class="table-info">
                            		<td align="center"><h4><i class="<?= ($notification->login == '1') ? 'uil-check-circle text-success' : 'uil-times-circle text-danger' ?>"></i></h4></td>
                            		<td align="center"><h4><i class="<?= ($notification->deposit == '1') ? 'uil-check-circle text-success' : 'uil-times-circle text-danger' ?>"></i></h4></td>
                            		<td align="center"><h4><i class="<?= ($notification->balance_transfer == '1') ? 'uil-check-circle text-success' : 'uil-times-circle text-danger' ?>"></i></h4></td>
                            	</tr>
                            	<tr class="table-info">
                            		<th>TRANSAKSI</th>
                            		<th>TIKET</th>
                            		<th>GANTI&nbsp;KATA&nbsp;SANDI</th>
                            	</tr>
                            	<tr class="table-info">
                            		<td align="center"><h4><i class="<?= ($notification->transaction == '1') ? 'uil-check-circle text-success' : 'uil-times-circle text-danger' ?>"></i></h4></td>
                            		<td align="center"><h4><i class="<?= ($notification->ticket == '1') ? 'uil-check-circle text-success' : 'uil-times-circle text-danger' ?>"></i></h4></td>
                            		<td align="center"><h4><i class="<?= ($notification->change_password == '1') ? 'uil-check-circle text-success' : 'uil-times-circle text-danger' ?>"></i></h4></td>
                            	</tr>
                            	<tr class="table-info">
                            		<th>GANTI&nbsp;PIN&nbsp;KEAMANAN</th>
                            	</tr>
                            	<tr class="table-info">
                            		<td align="center"><h4><i class="<?= ($notification->change_pin == '1') ? 'uil-check-circle text-success' : 'uil-times-circle text-danger' ?>"></i></h4></td>
                            	</tr>
                            	<?php } ?>
                            	
                            	<tr>
                            		<th>JENIS&nbsp;KELAMIN</th>
                            		<td><?= $target->gender ?></td>
                            	</tr>
                            	<tr>
                            		<th>BONUS&nbsp;REFERRAL</th>
                            		<td colspan="2">Rp <?= number_format($target->referral_bonus,0,',','.') ?></td>
                            	</tr>
                            	<tr>
                            		<th>KODE&nbsp;REFERRAL</th>
                            		<td colspan="2"><?= $target->code_referral ?></td>
                            	</tr>
                            	<tr>
                            		<th>DIDAFTARKAN&nbsp;OLEH</th>
                            		<td colspan="2"><?= $uplink ?></td>
                            	</tr>
                            	<tr>
                            		<th>TANGGAL&nbsp;DAFTAR</th>
                            		<td colspan="2"><?= $this->lib->format_date($target->created_at) ?>, <?= $this->lib->format_time($target->created_at) ?></td>
                            	</tr>
                            </table>
        			    </div>
                        <script type="text/javascript">
                            autosize(document.getElementById("note"));
                        </script>