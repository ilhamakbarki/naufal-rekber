                        <div class="row">
                        	<div class="col-sm-12">
                        		<div class="card">
                        		    <div class="card-body">
                            		    <h4 class="card-title mb-4"><i class="uil-dollar-sign text-primary"></i> Fee</h4>
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                            	<thead>
                                            		<tr>
                                            			<th>ID</th>
                                            			<th>FEE&nbsp;MULAI&nbsp;DARI</th>
                                            			<th>FEE&nbsp;SAMPAI&nbsp;KE</th>
                                            			<th>FEE</th>
                                            			<th>AKSI</th>
                                            		</tr>
                                            	</thead>
                                            	<tbody>
                                                    <?php
                                                    foreach ($table as $key => $value) {
                                                    if ($value['to'] == '-') {
                                                        $to = '-';
                                                    } else {
                                                        $to = number_format($value['to'],0,',','.');
                                                    }
                                                    ?>
    
                                        			<tr>
                                        				<td><?= $value['id'] ?></td>
                                        				<td>Rp <?= number_format($value['from'],0,',','.') ?></td>
                                        				<td>Rp <?= $to ?></td>
                                        				<td>Rp <?= number_format($value['fee'],0,',','.') ?></td>
                                        				<td align="center">
                                        					<a href="<?= base_url('admin/'.$this->uri->segment(2).'/edit/'.$value['id']) ?>" class="btn btn-warning btn-sm"><i class="uil-edit"></i></a> 
                                        				</td>
                                        			</tr>
                                                    <?php } ?>

                                        	    </tbody>
                                            </table>
                                            <div>
                                            	<ul class="pagination pagination-split" style="margin: 20px 0;">
                                            	    <li class="disabled page-item">
                                            	        <a class="page-link" href="#">Total Data : <?= $total_data ?></a>
                                            	    </li>
                                            	    <?= $this->pagination->create_links() ?>
    
                                            	</ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>