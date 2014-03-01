<?php $this->inc('elements/_header.php') ?>	
	<div class="pure-u-1" id="cadre-noir">
		<div id="slide">
			<?php
			   $slider = new Area('slider');
			   if (($slider->getTotalBlocksInArea($c) > 0) || ($c->isEditMode())) {
			       $slider->setBlockLimit(1);
			       $slider->display($c);
			   } else { ?>
					<img id="img" src="http://lorempixel.com/960/342">
			  <?php } ?>
		</div>
		<div id="dessous">
			<img id="ombre" src="<?php echo $this->getThemePath();?>/pure/img/ombreslider.png">
			<?php 
			    $titre = new Area('un titre de niveau 3');
			    if (($titre->getTotalBlocksInArea($c) > 0) || ($c->isEditMode())) {
					$titre->setBlockLimit(1);
					$titre->display($c);
			    } else { ?>
			   		<h3>Lorem ipsum dolor sit amet, consectetur adipisicing elit</h3>
		    <?php } ?>
		</div>
	</div>
	<div class="pure-u-1" id="content">
		<div class="container" id="container1">
			<div id="trait"></div>
			<div class="pure-u-1-3">
				<div class="groupe">
					<?php 
					   $a = new Area('contenu 1');
				       $a->setBlockLimit(1);
				       $a->display($c);
					?>
				</div>
			</div>
			<div class="pure-u-1-3">
				<div class="groupe">
					<?php 
					   $b = new Area('contenu 2');
				       $b->setBlockLimit(1);
				       $b->display($c);
					?>
				</div>
			</div>
			<div class="pure-u-1-3">
				<div class="groupe">
					<?php 
					   $d = new Area('contenu 3');
				       $d->setBlockLimit(1);
				       $d->display($c);
					?>
				</div>
			</div>
		</div>
		<div class="container" id="container2">
			<div id="trait"></div>
			<div class="pure-u-1-3">
				<div class="groupe">
					<?php 
						$social = new Area('social');
						$social->setBlockLimit(1);
						$social->display($c);
					?>
				</div>
				<div class="groupe" id="newsletter">
					<?php 
						$newsletter = new Area('newsletter');
						$newsletter->setBlockLimit(1);
						$newsletter->display($c);
					?>
				</div>
			</div>
			<div class="pure-u-1-3">
				<div class="groupe">
					<?php 
						$Contact = new Area('Contact');
						$Contact->setBlockLimit(1);
						$Contact->display($c);
					?>
				</div>
			</div>
			<div class="pure-u-1-3">
				<div class="groupe">
					<?php 
						$news = new Area('news');
						$news->setBlockLimit(1);
						$news->display($c);
					?>
				</div>
			</div>
		</div>
	</div>
<?php $this->inc('elements/_footer.php') ?>	
