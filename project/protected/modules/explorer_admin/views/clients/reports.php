<div class="page-heading">
    <h1>Informes - <small><?php echo $order->title; ?> - <?php echo $order->client0->name; ?></small></h1>
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
								<a class="btn btn-success" href="<?php echo $this->createUrl('clients/report_add/'.$order->id_order); ?>"><i class="fa fa-plus-circle"></i> Add new</a>
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
									<th>Fecha</th>
									<th>Archivo</th>
									<th>Comentarios</th>
									<th>Estado</th>
								</tr>
					        </thead>
					 
					        <tfoot>
					            <tr>
					                <th>#</th>
									<th>Acciones</th>
									<th>Fecha</th>
									<th>Archivo</th>
									<th>Comentarios</th>
									<th>Estado</th>
					            </tr>
					        </tfoot>
					 
					        <tbody>
					            <?php
					            	foreach ($reports as $key => $report) { ?>
										<tr>
											<td style="text-align:center;"><?php echo $key+1; ?></td>
											<td style="width:120px;">
												<div class="btn-group btn-group-xs">
													<a href="<?php echo $this->createUrl('clients/reports_update/'.$report->id_report); ?>" data-toggle="tooltip" title="Editar" class="btn btn-default"><i class="fa fa-edit"></i></a>
													<?php if($report->status == 1){ ?>
														<a href="<?php echo $this->createUrl('clients/report_status')."/".$report->id_report; ?>" data-toggle="tooltip" title="Desactivar" class="btn btn-default"><i class="fa fa-minus-circle"></i></a>
													<?php } else{ ?>
														<a href="<?php echo $this->createUrl('clients/report_status')."/".$report->id_report; ?>" data-toggle="tooltip" title="Activar" class="btn btn-default"><i class="fa fa-check"></i></a>
													<?php } ?>
													<a data-msj='¿Esta seguro de querer eliminar el informe? Despues no podra recuperar sus datos, recuerde que otra opción es dejarla oculta.' href="<?php echo $this->createUrl('clients/delete_report')."/".$report->id_report; ?>" data-toggle="tooltip" title="Eliminar" class="js-confirm btn btn-default"><i class="fa fa-power-off"></i></a>
												</div>
											</td>
											<td><?php echo Yii::app()->dateFormatter->formatDateTime($report->date,'long',null); ?></td>
											<td><a target="_blank" href="<?php echo Yii::app()->request->baseUrl; ?>/files/<?php echo $report->file; ?>"><?php echo $report->file; ?></a></td>
											<td><?php echo $report->comments; ?></td>
											<td><span class="label label-<?php echo($report->status == 1)?"success":"warning" ?>"><?php echo ($report->status == 1)?'Mostrandose':'Oculta'; ?></span></td>
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
		<a href="<?php echo $this->createUrl('clients/orders/'.$order->client); ?>" class="btn btn-danger">Ordenes - <?php echo $order->client0->name; ?></a>
	</div>
</div>