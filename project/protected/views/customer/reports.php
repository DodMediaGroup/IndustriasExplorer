<div class="page">
	<article>
		<p class="art-date"><?php echo $order->orderStatus->name; ?></p>
		<h1><?php echo $order->number.' - '.$order->title; ?></h1>
		<p><?php echo $order->description; ?></p>
		<hr>
		<h4>Informes</h4>
		<?php if(count($reports) > 0){ ?>
			<table>
				<thead>
					<tr>
						<th style="width: 40px;">#</th>
						<th>Comentario</th>
						<th style="width: 110px;">Fecha</th>
						<th style="width: 150px;">Archivo</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($reports as $key => $report) { ?>
						<tr>
							<td><?php echo $key+1; ?></td>
							<td><?php echo $report->comments; ?></td>
							<td><?php echo $report->date; ?></td>
							<td><a target="_blank" href="<?php echo Yii::app()->request->baseUrl; ?>/files/<?php echo $report->file; ?>"><?php echo $report->file; ?></a></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		<?php }
		else{ ?>
			<p>No hay informes para la orden de trabajo.</p>
		<?php } ?>
	</article>
</div>