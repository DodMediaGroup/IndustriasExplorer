<div class="page-heading">
    <h1>Ordenes de trabajo - <small><?php echo $client->name; ?></small></h1>
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
								<a class="btn btn-success" href="<?php echo $this->createUrl('clients/orders_add/'.$client->id_client); ?>"><i class="fa fa-plus-circle"></i> Add new</a>
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
									<th>Número</th>
									<th>Título</th>
									<th>Descripción</th>
									<th>Estado de orden</th>
									<th>Estado</th>
								</tr>
					        </thead>
					 
					        <tfoot>
					            <tr>
					                <th>#</th>
									<th>Acciones</th>
									<th>Número</th>
									<th>Título</th>
									<th>Descripción</th>
									<th>Estado de orden</th>
									<th>Estado</th>
					            </tr>
					        </tfoot>
					 
					        <tbody>
					            <?php
					            	foreach ($orders as $key => $order) { ?>
										<tr>
											<td style="text-align:center;"><?php echo $key+1; ?></td>
											<td style="width:120px;">
												<div class="btn-group btn-group-xs">
													<a href="<?php echo $this->createUrl('clients/orders_update/'.$order->id_order); ?>" data-toggle="tooltip" title="Editar" class="btn btn-default"><i class="fa fa-edit"></i></a>
													<a href="<?php echo $this->createUrl('clients/reports/'.$order->id_order); ?>" data-toggle="tooltip" title="Informes" class="btn btn-default"><i class="fa fa-building-o"></i></a>
													<?php if($order->status == 1){ ?>
														<a href="<?php echo $this->createUrl('clients/order_status')."/".$order->id_order; ?>" data-toggle="tooltip" title="Desactivar" class="btn btn-default"><i class="fa fa-minus-circle"></i></a>
													<?php } else{ ?>
														<a href="<?php echo $this->createUrl('clients/order_status')."/".$order->id_order; ?>" data-toggle="tooltip" title="Activar" class="btn btn-default"><i class="fa fa-check"></i></a>
													<?php } ?>
													<a data-msj='¿Esta seguro de querer eliminar la orden de trabajo "<?php echo $order->title; ?>"? Despues no podra recuperar sus datos, recuerde que otra opción es dejarla oculta.' href="<?php echo $this->createUrl('clients/delete_order')."/".$order->id_order; ?>" data-toggle="tooltip" title="Eliminar" class="js-confirm btn btn-default"><i class="fa fa-power-off"></i></a>
												</div>
											</td>
											<td><?php echo $order->number ?></td>
											<td><?php echo $order->title; ?></td>
											<td><?php echo $order->description; ?></td>
											<td><?php echo $order->orderStatus->name; ?></td>
											<td><span class="label label-<?php echo($order->status == 1)?"success":"warning" ?>"><?php echo ($order->status == 1)?'Mostrandose':'Oculta'; ?></span></td>
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

<div class="row">
	<div class="col-sm-12">
		<a href="<?php echo $this->createUrl('clients/admin'); ?>" class="btn btn-danger">Clientes</a>
	</div>
</div>