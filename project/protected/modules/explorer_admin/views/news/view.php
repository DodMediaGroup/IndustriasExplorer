<div class="page-heading">
    <h1><?php echo $new->title; ?></h1>
</div>

<hr>

<div class="row">
	<div class="col-sm-12">
		<div class="widget">
			<div class="widget-content padding content-variable">
				<ul class="nav nav-tabs">
					<li class="active">
						<a href="#page_<?php echo $new->language0->name ?>" data-toggle="tab"><?php echo $new->language0->name ?></a>
					</li>
					<?php foreach ($new->news as $key => $child) { ?>
						<li class="">
							<a href="#page_<?php echo $child->language0->name ?>" data-toggle="tab"><?php echo $child->language0->name ?></a>
						</li>
					<?php } ?>
				</ul>

				<div class="tab-content tab-boxed">
					<div class="tab-pane fade active in" id="page_<?php echo $new->language0->name ?>">
						<h1><?php echo $new->title; ?></h1>
						<div style="display:table;">
							<?php if($new->image != ""){ ?>
								<img style="float:right;" src="<?php echo Yii::app()->request->baseUrl; ?>/images/news/<?php echo $new->image; ?>" alt="">
							<?php } ?>
							<?php echo $new->new; ?>
						</div>
					</div> <!-- / .tab-pane -->
					<?php foreach ($new->news as $key => $child) { ?>
						<div class="tab-pane fade" id="page_<?php echo $child->language0->name ?>">
							<h1><?php echo $child->title; ?></h1>
							<div style="display:table;">
								<?php if($child->original0->image != ""){ ?>
									<img style="float:right;" src="<?php echo Yii::app()->request->baseUrl; ?>/images/news/<?php echo $child->original0->image; ?>" alt="">
								<?php } ?>
								<?php echo $child->new; ?>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>