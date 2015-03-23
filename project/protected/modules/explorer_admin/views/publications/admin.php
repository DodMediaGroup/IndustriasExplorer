<div class="page-heading">
    <h1>Administración Noticias</h1>
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
								<a class="btn btn-success" href="<?php echo $this->createUrl('publications/create'); ?>"><i class="fa fa-plus-circle"></i> Add publication</a>
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
									<th>Titulo</th>
									<th>Lenguajes</th>
									<th>Archivo</th>
									<th>Fecha</th>
									<th>Estado</th>
								</tr>
					        </thead>
					 
					        <tfoot>
					            <tr>
					                <th>#</th>
									<th>Acciones</th>
									<th>Titulo</th>
									<th>Lenguajes</th>
									<th>Archivo</th>
									<th>Fecha</th>
									<th>Estado</th>
					            </tr>
					        </tfoot>
					 
					        <tbody>
					            <?php
					            	foreach ($publications as $key => $publication) { ?>
										<tr>
											<td style="text-align:center;"><?php echo $key+1; ?></td>
											<td style="width:120px;">
												<div class="btn-group btn-group-xs">
													<a href="<?php echo $this->createUrl('publications/'.$publication->id_publication); ?>" data-toggle="tooltip" title="Ver" class="btn btn-default"><i class="fa fa-external-link"></i></a>
													<a href="<?php echo $this->createUrl('publications/update/'.$publication->id_publication); ?>" data-toggle="tooltip" title="Editar" class="btn btn-default"><i class="fa fa-edit"></i></a>
													<?php if($publication->status == 1){ ?>
														<a href="<?php echo $this->createUrl('publications/status')."/".$publication->id_publication; ?>" data-toggle="tooltip" title="Ocultar" class="btn btn-default"><i class="fa fa-minus-circle"></i></a>
													<?php } else{ ?>
														<a href="<?php echo $this->createUrl('publications/status')."/".$publication->id_publication; ?>" data-toggle="tooltip" title="Mostrar" class="btn btn-default"><i class="fa fa-check"></i></a>
													<?php } ?>
													<a data-msj='¿Esta seguro de querer eliminar la publicación "<?php echo $publication->title; ?>"? Despues no podra recuperar sus datos, recuerde que otra opción es dejarla oculta.' href="<?php echo $this->createUrl('publications/delete_publication')."/".$publication->id_publication; ?>" data-toggle="tooltip" title="Eliminar" class="js-confirm btn btn-default"><i class="fa fa-power-off"></i></a>
												</div>
											</td>
											<td><?php echo $publication->title; ?></td>
											<td>
												<span class="label label-primary"><?php echo $publication->language0->name; ?></span>
												<?php foreach ($publication->publications as $key => $child) { ?>
													<span class="label label-primary"><?php echo $child->language0->name; ?></span>
												<?php } ?>
											</td>
											<td><a href="<?php echo Yii::app()->request->baseUrl; ?>/files/publications/<?php echo $publication->file; ?>" target="_blank"><?php echo $publication->file; ?></a></td>
											<td><?php echo Yii::app()->dateFormatter->formatDateTime($publication->date,'long',null); ?></td>
											<td><span class="label label-<?php echo($publication->status == 1)?"success":"warning" ?>"><?php echo ($publication->status == 1)?'Activo':'Oculto'; ?></span></td>
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