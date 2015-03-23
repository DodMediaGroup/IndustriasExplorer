<?php $path = explode("/",Yii::app()->request->pathInfo); ?>
<li>
	<a href='<?php echo $this->createUrl('index/') ?>' class="<?php echo (count($path) > 1)?((strtolower($path[1]) == 'index')?'active':''):'active'; ?>">
		<i class='icon-home-3'></i>
		<span>Dashboard</span>
	</a>
</li>

<li>
	<a href='<?php echo $this->createUrl('news/admin') ?>' class="<?php echo (count($path) > 1)?((strtolower($path[1]) == 'news')?'active':''):''; ?>">
		<i class='icon-newspaper'></i>
		<span>Noticias</span>
	</a>
</li>

<li>
	<a href='<?php echo $this->createUrl('publications/admin') ?>' class="<?php echo (count($path) > 1)?((strtolower($path[1]) == 'publications')?'active':''):''; ?>">
		<i class='icon-folder-3'></i>
		<span>Publicaciones</span>
	</a>
</li>

<li>
	<a href='<?php echo $this->createUrl('clients/admin') ?>' class="<?php echo (count($path) > 1)?((strtolower($path[1]) == 'clients')?'active':''):''; ?>">
		<i class='icon-users-1'></i>
		<span>Clientes</span>
	</a>
</li>

<li class='has_sub'>
	<a href='#'>
		<i class='icon-monitor-1'></i>
		<span>Sitio</span>
		<span class="pull-right">
			<i class="fa fa-angle-down"></i>
		</span>
	</a>
	<ul>
		<li>
			<a href='<?php echo $this->createUrl('pages/admin') ?>' class="<?php echo (count($path) > 1)?((strtolower($path[1]) == 'pages')?'active':''):''; ?>">
				<span>Paginas</span>
			</a>
		</li>
		<li>
			<a href='<?php echo $this->createUrl('menus/admin') ?>' class="<?php echo (count($path) > 1)?((strtolower($path[1]) == 'menus')?'active':''):''; ?>">
				<span>Menus</span>
			</a>
		</li>
	</ul>
</li>

<li>
	<a href='<?php echo $this->createUrl('galleries/admin') ?>' class="<?php echo (count($path) > 1)?((strtolower($path[1]) == 'galleries')?'active':''):''; ?>">
		<i class='icon-picture-2'></i>
		<span>Galerias</span>
	</a>
</li>