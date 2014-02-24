
<!DOCTYPE html>
<html lang="fr">
    <head>
        <?php Loader::element('header_required'); ?>
        <meta charset="utf-8">
        <title>Mon blog</title>

        <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
        <!--[if lt IE 9]>
          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <link href="<?php echo $this->getThemePath(); ?>/assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo $this->getThemePath(); ?>/assets/css/main.css" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="page-header well">
                    <h1>Mon Blog <small>Pour m'initier à PHP</small></h1>
                </div>
                

                <div class="row">
                    <div class="span8">
                        <!-- notifications -->
                        <!-- contenu -->

                        <?php
                        $a = new Area('contenu');
                        $a->display($c);
                        ?>
                    </div>

                    <nav class="span4">
                        <h2>Menu</h2>
                        <?php
                        $a = new Area('menu');
                        $a->display($c);
                        ?>
                    </nav>
                </div>
            </div>
            <footer>
                <p>&copy; ULCO 2012</p>
            </footer>
        </div>
        <?php Loader::element('footer_required'); ?>
    </body>
</html>

