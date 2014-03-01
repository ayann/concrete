<?php $this->inc('elements/_header.php') ?>	
	<div class="pure-u-1" id="content">
		<div class="container">
			
			<?php
				$a = new Area("content");
				$a->display($c);
			?>
			
		</div>
	</div>
<?php $this->inc('elements/_footer.php') ?>	
