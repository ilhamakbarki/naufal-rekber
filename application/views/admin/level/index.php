                        <div class="row">
                        	<div class="col-sm-12">
                        		<div class="card">
                        		    <div class="card-body">
                            		    <h4 class="card-title mb-4"><i class="uil-arrow-up text-primary"></i> Level</h4>
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                            	<thead>
                                            		<tr>
                                            			<th>ID&nbsp;LEVEL</th>
                                            			<th>NAMA&nbsp;LEVEL</th>
                                            			<th>AKSI</th>
                                            		</tr>
                                            	</thead>
                                            	<tbody>
                                                    <?php
                                                    foreach ($table as $key => $value) {
                                                    ?>
    
                                        			<tr>
                                        				<td><?= $value['level'] ?></td>
                                        				<td><?= $value['level_name'] ?></td>
                                        				<td align="center">
                                        					<a href="<?= base_url('admin/'.$this->uri->segment(2).'/edit/'.$value['level']) ?>" class="btn btn-warning btn-sm"><i class="uil-edit"></i></a> 
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