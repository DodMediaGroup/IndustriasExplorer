<div class="page">
	<?php echo $page->body; ?>
	<div class="form">
		<form action="<?php echo $this->createUrl('site/contact'); ?>" class="form-horizontal js-form-contact">
			<div class="form-group">
				<label for="contact-name" class="col-xs-3 control-label">Nombre*</label>
				<div class="col-xs-9">
					<input type="text" class="form-control" name="name" required>
				</div>
			</div>
			<div class="form-group">
				<label for="contact-last_name" class="col-xs-3 control-label">Apellido*</label>
				<div class="col-xs-9">
					<input type="text" class="form-control" name="last_name" required>
				</div>
			</div>
			<div class="form-group">
				<label for="contact-email" class="col-xs-3 control-label">Email*</label>
				<div class="col-xs-9">
					<input type="email" class="form-control" name="email" required>
				</div>
			</div>
			<div class="form-group">
				<label for="contact-subjet" class="col-xs-3 control-label">Asunto*</label>
				<div class="col-xs-9">
					<input type="text" class="form-control" name="subjet" required>
				</div>
			</div>
			<div class="form-group">
				<label for="contact-message" class="col-xs-3 control-label">Mensaje*</label>
				<div class="col-xs-9">
					<textarea name="message" class="form-control" rows="7" required></textarea>
				</div>
			</div>
			<div class="form-group">
				<div class="col-xs-offset-3 col-xs-9">
					<button type="submit" class="btn btn-default">Enviar</button>
				</div>
			</div>
		</form>
		<span>*Campos requeridos</span>
	</div>
	<address>
		<p>Duitama - Boyacá</p>
		<p>Planta Av. las Américas 20 - 60</p>
		<p>Tel: (57) 8-7631252 /8 - 7631254 Fax: 8-7602661</p>
		<p>e-mail: gerencia@industriasexplorer.com</p>
		<p>secretaria@industriasexplorer.com</p>
		<p>www.industriasexplorer.com</p>
	</address>
</div>