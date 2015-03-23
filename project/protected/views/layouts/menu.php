<?php
	$language = Yii::app()->request->cookies['language']->value;
	$menu = Menus::model()->findByAttributes(array('language'=>$language, 'status'=>1));
	if($menu == null)
		$menu = Menus::model()->findByPk(1);
	$items = MenuItems::model()->findAllByAttributes(array('menu'=>$menu->id_menu, 'node'=>null));
?>
<nav class="principal-menu">
	<ul class="menu">
		<?php foreach ($items as $key => $item) { ?>
			<li>
				<a <?php echo ($item->page != "")?('href="'.$this->createUrl('/'.$item->page0->navigation).'"'):''; ?>><?php echo $item->name ?></a>
				<?php if(count($item->menuItems) > 0){ ?>
					<ul class="sub-menu">
						<?php foreach ($item->menuItems as $key => $subItem) { ?>
							<li><a href="<?php echo $this->createUrl('/'.(($subItem->page != "")?$subItem->page0->navigation:'#')) ?>"><?php echo $subItem->name ?></a></li>
						<?php } ?>
					</ul>
				<?php } ?>
			</li>
		<?php } ?>
	</ul>
</nav>