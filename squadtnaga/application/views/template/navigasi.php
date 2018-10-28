<div class="navbar" id="navbarutama">
	<ul class="nav navbar-nav navbar-right" id="navutama">
		<?php
		foreach($allmenu as $result=>$menu):
		?>
		<li 
		<?php
		if($activemenu == $menu->nama):
			echo 'class="active"';
		endif;
		?>
		>
			<a 
			href="<?=site_url($menu->link)?>"
			>
			<?php
			if($menu->glyphicon):
				echo '<span class="glyphicon glyphicon-'.$menu->id_glyph.'"></span> ';
			endif;
			?>
			<?=$menu->nama?>
			</a>
		</li>
		<?php
		endforeach;
		?>
	</ul>
</div>