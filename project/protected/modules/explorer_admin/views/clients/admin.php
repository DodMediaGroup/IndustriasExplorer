<div class="page-heading">
    <h1>Administración Clientes</h1>
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
				<div class="data-table-toolbar">
					<div class="row">
						<div class="col-md-8 col-md-offset-4">
							<div class="toolbar-btn-action">
								<a class="btn btn-success" href="<?php echo $this->createUrl('clients/create'); ?>"><i class="fa fa-plus-circle"></i> Add new</a>
							</div>
						</div>
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
									<th></th>
									<th>Nombre</th>
									<th>Usuario</th>
									<th>Estado</th>
								</tr>
					        </thead>
					 
					        <tfoot>
					            <tr>
					                <th>#</th>
									<th>Acciones</th>
									<th></th>
									<th>Nombre</th>
									<th>Usuario</th>
									<th>Estado</th>
					            </tr>
					        </tfoot>
					 
					        <tbody>
					            <?php
					            	foreach ($clients as $key => $client) { ?>
										<tr>
											<td style="text-align:center;"><?php echo $key+1; ?></td>
											<td style="width:120px;">
												<div class="btn-group btn-group-xs">
													<a href="<?php echo $this->createUrl('clients/update/'.$client->id_client); ?>" data-toggle="tooltip" title="Editar" class="btn btn-default"><i class="fa fa-edit"></i></a>
													<a href="<?php echo $this->createUrl('clients/orders/'.$client->id_client); ?>" data-toggle="tooltip" title="Ordenes de Trabajo" class="btn btn-default"><i class="fa fa-bullhorn"></i></a>
													<?php if($client->status == 1){ ?>
														<a href="<?php echo $this->createUrl('clients/status')."/".$client->id_client; ?>" data-toggle="tooltip" title="Desactivar" class="btn btn-default"><i class="fa fa-minus-circle"></i></a>
													<?php } else{ ?>
														<a href="<?php echo $this->createUrl('clients/status')."/".$client->id_client; ?>" data-toggle="tooltip" title="Activar" class="btn btn-default"><i class="fa fa-check"></i></a>
													<?php } ?>
													<a data-msj='¿Esta seguro de querer eliminar el cliente "<?php echo $client->name; ?>"? Despues no podra recuperar sus datos, recuerde que otra opción es dejarla oculta.' href="<?php echo $this->createUrl('clients/delete_client')."/".$client->id_client; ?>" data-toggle="tooltip" title="Eliminar" class="js-confirm btn btn-default"><i class="fa fa-power-off"></i></a>
												</div>
											</td>
											<td><div class="img-circl img-table-rep" style="background-image:url(<?php echo Yii::app()->request->baseUrl; ?>/images/clients/<?php echo ($client->image != ""?$client->image:'default.jpg'); ?>);"></div></td>
											<td><?php echo $client->name; ?></td>
											<td><?php echo $client->user; ?></td>
											<td><span class="label label-<?php echo($client->status == 1)?"success":"warning" ?>"><?php echo ($client->status == 1)?'Activo':'Inactivo'; ?></span></td>
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