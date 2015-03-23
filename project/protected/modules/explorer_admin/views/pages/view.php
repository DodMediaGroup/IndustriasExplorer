<div class="page-heading">
    <h1><?php echo $model->title; ?></h1>
</div>

<hr>

<div class="row">
	<div class="col-sm-12">
		<div class="widget">
			<div class="widget-content padding content-variable">
				<ul class="nav nav-tabs">
					<li class="active">
						<a href="#page_<?php echo $model->language0->name ?>" data-toggle="tab"><?php echo $model->language0->name ?></a>
					</li>
					<?php foreach ($model->pages as $key => $child) { ?>
						<li class="">
							<a href="#page_<?php echo $child->language0->name ?>" data-toggle="tab"><?php echo $child->language0->name ?></a>
						</li>
					<?php } ?>
				</ul>

				<div class="tab-content tab-boxed">
					<div class="tab-pane fade active in" id="page_<?php echo $model->language0->name ?>">
						<h1><?php echo $model->title; ?></h1>
						<?php echo $model->body; ?>
					</div> <!-- / .tab-pane -->
					<?php foreach ($model->pages as $key => $child) { ?>
						<div class="tab-pane fade" id="page_<?php echo $child->language0->name ?>">
							<h1><?php echo $child->title; ?></h1>
							<?php echo $child->body; ?>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>