<div class="page-heading">
    <h1><?php echo $publication->title; ?></h1>
</div>

<hr>

<div class="row">
	<div class="col-sm-12">
		<div class="widget">
			<div class="widget-content padding content-variable">
				<ul class="nav nav-tabs">
					<li class="active">
						<a href="#page_<?php echo $publication->language0->name ?>" data-toggle="tab"><?php echo $publication->language0->name ?></a>
					</li>
					<?php foreach ($publication->publications as $key => $child) { ?>
						<li class="">
							<a href="#page_<?php echo $child->language0->name ?>" data-toggle="tab"><?php echo $child->language0->name ?></a>
						</li>
					<?php } ?>
				</ul>

				<div class="tab-content tab-boxed">
					<div class="tab-pane fade active in" id="page_<?php echo $publication->language0->name ?>">
						<h1><?php echo $publication->title; ?></h1>
						<strong><small><?php echo $publication->date; ?></small></strong>
						<?php echo $publication->description; ?>
						<a href="<?php echo Yii::app()->request->baseUrl; ?>/files/publications/<?php echo $publication->file; ?>" target="_blank"><?php echo $publication->file; ?></a>
					</div> <!-- / .tab-pane -->
					<?php foreach ($publication->publications as $key => $child) { ?>
						<div class="tab-pane fade" id="page_<?php echo $child->language0->name ?>">
							<h1><?php echo $child->title; ?></h1>
							<strong><small><?php echo $child->date; ?></small></strong>
							<?php echo $child->description; ?>
							<a href="<?php echo Yii::app()->request->baseUrl; ?>/files/publications/<?php echo $publication->file; ?>" target="_blank"><?php echo $publication->file; ?></a>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>