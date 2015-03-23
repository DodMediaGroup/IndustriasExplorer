<div class="page">
	<h1><?php echo $page->title; ?></h1>
	<?php foreach ($news as $key => $new) { ?>
		<article>
			<p class="art-date"><?php echo $new->date; ?></p>
			<h1 class="art-title"><?php echo $new->title; ?></h1>
			<p><?php echo substr(strip_tags($new->new), 0, 310); ?>… <a href="<?php echo $this->createUrl($page->navigation.'/'.$new->id_new.'_'.MyMethods::normalizarUrl($new->title)) ?>">Leer más</a></p>
		</article>
	<?php } ?>
</div>