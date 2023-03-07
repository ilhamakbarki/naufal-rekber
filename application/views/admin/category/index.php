                        <div class="row">
                        	<div class="col-sm-12">
                        		<div class="card">
                        		    <div class="card-body">
                        			    <div class="float-end">
                            		        <a href="<?= base_url('admin/'.$this->uri->segment(2).'/add') ?>" class="btn btn-success btn-sm"><i class="uil-plus"></i> Tambah Kategori</a>
                        			    </div>
                            		    <h4 class="card-title mb-4"><i class="uil-list-ul text-primary"></i> Kategori</h4>
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                            	<thead>
                                            		<tr>
                                            			<th>ID&nbsp;KATEGORI</th>
                                            			<th>NAMA&nbsp;KATEGORI</th>
                                            			<th>AKSI</th>
                                            		</tr>
                                            	</thead>
                                            	<tbody>
                                                    <?php
                                                    foreach ($table as $key => $value) {
                                                    ?>
    
                                        			<tr>
                                        				<td><?= $value['category'] ?></td>
                                        				<td><?= $value['category_name'] ?></td>
                                        				<td align="center">
                                        					<a href="<?= base_url('admin/'.$this->uri->segment(2).'/edit/'.$value['category']) ?>" class="btn btn-warning btn-sm"><i class="uil-edit"></i></a> 
                                                            <a href="javascript: void(0);" onclick="confirm_delete('<?= base_url('admin/'.$this->uri->segment(2).'/delete/'.$value['category']) ?>')" class="btn btn-danger btn-sm"><i class="uil-trash"></i></a>
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