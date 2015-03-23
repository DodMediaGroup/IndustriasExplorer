<div class="page-heading">
    <h1>Administración Menu Principal</h1>
</div>

<div class="row">
    <div class="col-md-12">
		<div class="widget">
			<div class="widget-content">
				<div class="widget-header transparent">
					<div class="additional-btn">
						<a href="#" class="hidden reload"><i class="icon-ccw-1"></i></a>
					</div>
				</div>
				<br>
				<div class="table-responsive">
					<form class='form-horizontal' role='form'>
						<table class="table table-striped table-bordered js-data-table" cellspacing="0" width="100%">
					        <thead>
					            <tr align="center">
									<th>#</th>
									<th>Acciones</th>
									<th>Idioma</th>
									<th>Menu creado</th>
								</tr>
					        </thead>
					 
					        <tfoot>
					            <tr>
					                <th>#</th>
									<th>Acciones</th>
									<th>Idioma</th>
									<th>Menu creado</th>
					            </tr>
					        </tfoot>
					 
					        <tbody>
					            <?php
					            	foreach ($languages as $key => $language) { ?>
					            		<?php
											$create = false;
											$current = Menus::model()->findByAttributes(array('language'=>$language->id_language));
											if($current != null)
												$create = true;
										?>
										<tr>
											<td style="text-align:center;"><?php echo $key+1; ?></td>
											<td style="width:145px;">
												<div class="btn-group btn-group-xs">
													<?php if(!$create){ ?>
														<a href="<?php echo $this->createUrl('menus/create')."/".$language->id_language; ?>" data-toggle="tooltip" title="Crear Menu" class="btn btn-default"><i class="fa fa-star-o"></i></a>
													<?php }
													else{ ?>
														<a href="<?php echo $this->createUrl('menus/update')."/".$language->id_language; ?>" data-toggle="tooltip" title="Editar Menu" class="btn btn-default"><i class="fa fa-edit"></i></a>
														<?php if($key != 0){ ?>
															<a data-msj="¿Esta seguro de querer eliminar el menu?" href="<?php echo $this->createUrl('menus/delete_menu')."/".$language->id_language; ?>" data-toggle="tooltip" title="Eliminar" class="js-confirm btn btn-default"><i class="fa fa-power-off"></i></a>
														<?php } ?>
													<?php } ?>
												</div>
											</td>
											<td><?php echo $language->name; ?></td>
											<td>
												<span class="label label-<?php echo($create)?"success":"warning" ?>"><?php echo ($create)?'Si':'No'; ?></span>
											</td>
										</tr>
									<?php }
								?>
					        </tbody>
					    </table>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>