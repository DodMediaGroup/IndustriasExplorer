<div class="page-heading">
    <h1>Editar Pagina - <small><?php echo $model->title; ?></small></h1>
</div>

<?php $this->renderPartial('_form', array(
										'model'=>$model,
						                'languages'=>$languages,
						                'galleries'=>$galleries
									)); ?>