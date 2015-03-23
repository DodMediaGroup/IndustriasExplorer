<div class="page-heading">
    <h1>Agregar página</h1>
</div>

<?php $this->renderPartial('_form', array(
										'model'=>$model,
										'languages'=>$languages,
            							'galleries'=>$galleries
									)); ?>