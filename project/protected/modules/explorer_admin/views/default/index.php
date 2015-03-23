<!-- Page Heading Start -->
<div class="page-heading">
    <h1>Administración Explorer</h1>
</div>
<!-- Page Heading End-->
<div class="row">
    <div class="col-md-12">
		<div class="widget">
			<div class="widget-header transparent">
				<h2><i class="icon-picture-2"></i> <strong>Slide</strong> Principal</h2>
				<div class="additional-btn">
					<a href="#" class="widget-maximize hidden"><i class="icon-resize-full-1"></i></a>
					<a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
					<a href="#" class="widget-close"><i class="icon-cancel-3"></i></a>
				</div>
			</div>
			<div class="widget-content">
				<div class="statistic-chart">	
					<div class="row stacked">
						<div class="col-sm-12">
							<div class="toolbar">
								<div class="pull-right">
									<label class="left">Galeria</label>
									<div class="btn-group">
										<select class="form-control" id="PrincipalSlide_Gallery">
											<?php foreach ($galleries as $key => $gallery) { ?>
												<option value="<?php echo $gallery->id_gallery; ?>" <?php echo ($currentGallery->id_gallery == $gallery->id_gallery)?'selected="selected"':''; ?>><?php echo $gallery->name; ?></option>
											<?php } ?>
										</select>
									</div>
									<a href="<?php echo $this->createUrl('generalvalue/set'); ?>" class="btn btn-primary btn-xs general-value-set" data-element-val="#PrincipalSlide_Gallery" data-value-bd="1" data-toggle="tooltip" title="Establecer"><i class="icon-check-1"></i></a>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="clearfix"></div>
							<div class="morris-chart principal-slide" style="height: 320px;">
								<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
									<div class="carousel-inner js-container-ajax" role="listbox">
										<?php foreach ($currentGallery->images as $key => $image) { ?>
											<div class="item <?php echo ($key==0)?'active':''; ?>">
						                        <div class="my-item-slide" style="background-image:url(<?php echo Yii::app()->request->baseUrl; ?>/images/galleries/<?php echo $currentGallery->id_gallery ?>/<?php echo $image->path; ?>)"></div>
						                    </div>
										<?php } ?>
									</div>
									<script type="text/javascript">
			                            loadAjax = {
			                                "url":"<?php echo $this->createUrl('galleries/loadGalleryFull'); ?>",
			                                "filter":null,
			                                "container":".js-container-ajax",
			                                "page":0,
			                                "load":false
			                            }
			                        </script>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
</div>