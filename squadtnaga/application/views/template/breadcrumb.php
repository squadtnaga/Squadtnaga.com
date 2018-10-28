<?php 
$uristring = explode('/',$this->uri->uri_string());
?>
<div class="row">
	<div class="col-sm-12">
		<ul class="breadcrumb" style="margin:0 auto;">
			<?php
			$i = 0;
			$currentsegment = '';
			$len = count($uristring);
			foreach ($uristring as $segment):
				$currentsegment.=$segment;
				if($i != $len-1):?>
				<li><a href="<?=site_url($currentsegment)?>"><?=$segment?></a></li>
				<?php
				else:?>
				<li class="active"><?=$segment?></li>
				<?php
				endif;
				$currentsegment.='/';
				$i++;
				endforeach;
				?>
		</ul>
	</div>
</div>