		<div class="pure-u-1" id="footer">
			<div class="container">
				<div class="pure-u-2-3">
					<div id="contenu">
						<p>expedita sit consectetur  sit amet, consectetur adipisicin gsapiente dolor!</p>
						<div class="liens">
							<?php
					            $a = new Area("nav2");
					            $a->setBlockLimit(1);
					            $a->display($c);
				            ?>
						</div>
						<div class="liens">
							<ul>
								<li><a href="#">Privacy Policy </a></li>
								<li><a href="#">Terms of use</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="pure-u-1-3">
					<div id="copyright">
						<p>Copyright 2010. Studio VIVROCKS. All Rights Reserved.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php Loader::element('footer_required');?>
</body>
</html>
