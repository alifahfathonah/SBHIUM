<div class="main_menu">
	<nav id="dropdown">
		<ul class="sf-menu clearfix">
		<?php foreach ($data as $menu):?>
			<?php $cek = Menuutama::model()->findAll(array('condition'=>'parentid = :parentid','order'=>'sort ASC','params'=>array(':parentid'=>$menu->id))); 
			?>
			<?php if(strpos(Yii::app()->request->requestUri, Yii::app()->createUrl($menu->link))===0):?><!-- Untuk Carent Menu -->
				<li class="current"><a href="<?= Yii::app()->createUrl($menu->link) ?>" class="trigger"><span><?= $menu->title ?></span></a>
			<?php else:?>
				<li><a href="<?= Yii::app()->createUrl($menu->link) ?>" class="trigger"><span><?= $menu->title ?></span></a>
			<?php endif;?>
				<ul>
				<?php foreach ($cek as $child):?>
					<li><a href="<?= Yii::app()->createUrl($child->link) ?>"><?= $child->title ?></a></li>
				<?php endforeach;?>
				</ul>
			</li>
		<?php endforeach;?>
		</ul>
	</nav>	
</div>			

<!-- <div class="main_menu">
	<nav id="dropdown">
		<ul class="sf-menu clearfix">								
			<li class="current">
				<a href="<?= Yii::app()->createUrl('/home') ?>" class="trigger"><span>Home</span></a>
			</li>

			<li>
				<a href="<?= Yii::app()->createUrl('/about') ?>" class="trigger"><span>About Us</span></a>
			</li>

			<li>
			<a href="#" class="trigger"><span>Blog</span></a>
				<ul>
					<li><a href="<?= Yii::app()->createUrl('/blog/news') ?>">News</a></li>
					<li><a href="<?= Yii::app()->createUrl('/blog/article/') ?>">Article</a></li>
				</ul>
			</li>

			<li>
				<a href="<?= Yii::app()->createUrl('/portfolio') ?>" class="trigger"><span>Portfolio</span></a>
			</li>

			<li>
				<a href="<?= Yii::app()->createUrl('/testimoni') ?>" class="trigger"><span>Tetimonials</span></a>
			</li>

			<li><a href="<?= Yii::app()->createUrl('/contact') ?>"><span>Contact</span></a></li>							
		</ul>
	</nav>	
</div>			 -->