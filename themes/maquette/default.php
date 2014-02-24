<!DOCTYPE html>
<html>
    <head>
        <?php Loader::element('header_required'); ?>
        <title>20.01.2014</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
        
        <link rel="stylesheet" href="<?php echo $this->getThemePath(); ?>/assets/css/purecss-min.css">
        <link rel="stylesheet" href="<?php echo $this->getThemePath(); ?>/assets/css/main.css">
    </head>
    <body>
        <div id="global"> 
            <div id="header" class="pure-u-1" >
                <div class="">
                    <!--<a id="title" href="#" class="pure-menu-heading">Polo <b class="color-pink">3</b> <b class="color-blue">6</b> <b class="color-brown">0</b></a>-->
<!--                    <div class="pure-u-2-5"></div>-->
<!--                    <ul id="menu">-->
                        <?php
                        $a = new Area('menu');
                        $a->display($c);
                        ?>
<!--                        <li class="pure-menu-selected bordure-menu"><a href="#">Home</a></li>
                        <li class="bordure-menu"><a href="#">Flickr</a></li>
                        <li class="bordure-menu"><a href="#">Messenger</a></li>
                        <li class="bordure-menu"><a href="#">Sports</a></li>
                        <li><a href="#">Finance</a></li>-->
<!--                    </ul>-->
                </div>
            </div>
            
            <div id="slider">
                <div class="container">
                    
                        <?php
                        $a = new Area('slide');
                        $a->display($c);
                         ?>
                     
                </div>
               
            </div>
<!--            <div style="background-color: white">
                <div class="container">
                   
                    
                    <img id="slider-img" src="image/slide.png" alt="slide">
                </div>
                
            </div>-->
            
            
            
            <div id="content" class="pure-u-1">
                <div class="container">
                    <div id="slogan">
                        <h2> 
<!--                            Lorem ipsum dolor sit amet, consectetur adipisicing elit-->
                    <?php
                        $a = new Area('slogan');
                        $a->display($c);
                    ?>
                        </h2>
                    </div>
                    <hr class="h">
                    <div class="clear"></div>
                    <div id="article">
                        <?php
                        $a = new Area('article');
                        $a->display($c);
                        ?>
<!--                        <div class="article pure-u-1-5">
                            <h3 class="color-blue article-text">Perfect Logic <br><span class="color-grey">All you want yours website to do</span></h3>
                            <img class="article-img" alt="img art 1#" src="image/pngarticle.png"/>
                            <p class="article-text">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                            </p>
                            <a href="#" class="button">  Learn More</a>
                        </div>
                        <div class="pure-u-1-8"></div>
                        <div class="article pure-u-1-5">
                            <h3 class="color-blue article-text">Complete Solution <br><span class="color-grey">A tool anything and everything you can think</span></h3>
                            <img class="article-img" alt="img art 1#" src="image/pngarticle1.png"/>
                            <p class="article-text">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                            </p>
                            <a href="#" class="button">  Learn More</a>
                        </div>
                        <div class="pure-u-1-8"></div>
                        <div class="article pure-u-1-5">
                            <h3 class="color-blue article-text">Uber Culture <br><span class="color-grey">Fresh. Modern and ready for future</span></h3>
                            <img class="article-img" alt="img art 1#" src="image/pngarticle2.png"/>
                            <p class="article-text">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                            </p>
                            <a href="#" class="button">  Learn More</a>
                        </div>  -->
                        <div class="clear"></div>
                    </div>
                    <div class="clear"></div>
                    <hr class="h">
                    <div id="other">
                        <div class="clear"></div>
                        <?php
                        $a = new Area('other');
                        $a->display($c);
                    ?>
<!--                         <div class="article pure-u-1-5">
                            <h3 class="color-black-grey">Social Connection</h3>
                            <hr class="hr">
                            <p class="social">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                            </p>
                            <div class="social-img-div">
                                <a href="#"><img class="social-img" alt="" src="image/logosocial1.png"/></a>
                                <a href="#"><img class="social-img" alt="" src="image/logosocial2.png"/></a>
                                <a href="#"><img class="social-img" alt="" src="image/logosocial3.png"/></a>
                                <a href="#"><img class="social-img" alt="" src="image/logosocial4.png"/></a>
                                <a href="#"><img class="social-img" alt="" src="image/logosocial5.png"/></a>
                            </div>
                            <div class="clear"></div>
                            <h3 class="color-black-grey">Newletters</h3>
                            <hr class="hr">
                            <form class="pure-form">
                                <input class="pure-input-1" type="email" placeholder="Your email adress"><br><br>
                                <button type="submit" class="button-blue">  Subscrib</button>
                            </form>
                            
                        </div>
                        <div class="pure-u-1-8"></div>
                        <div class="article pure-u-1-5">
                            <h3 class="color-black-grey">Contact</h3>
                            <hr class="hr">
                            <form class="pure-form pure-form-aligned" >
                                <fieldset>
                                    <div class="pure-control-group">
                                        <input style="width: 284px;" id="name" type="text" placeholder="Your Name">
                                    </div>

                                    <div class="pure-control-group">
                                        <input style="width: 284px;" id="email" type="email" placeholder="Your email adress">
                                    </div>

                                    <div class="pure-control-group">
                                        <textarea style="width: 284px; height: 140px;" id="text" name="text" placeholder="Your text"></textarea>
                                    </div>
                                </fieldset>
                                <button type="submit" class="button-blue">  Send it</button>
                            </form>
                        </div>
                         <div class="pure-u-1-8"></div>
                        <div class="article pure-u-1-5">
                            <h3 class="color-black-grey">News Update</h3>
                            <hr class="hr">
                            <div class="blogcontent">
                                <p class="social"> <img class="blog-img" src="image/imgblog1.png"/> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et</p>
                            </div>
                            <hr class="hr">
                            <div class="blogcontent">
                                <p class="social"> <img class="blog-img" src="image/imgblog.png"/> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et</p>
                            </div>
                            <hr class="hr">
                            <div class="blogcontent">
                                <p class="social"> <img class="blog-img" src="image/imgblog2.png"/> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et</p>
                            </div>
                            
                                <a href="#" class="button-blue">  Visit our blog</a>
                            
                        </div>-->
                    </div>
                </div>
            </div>
            
            <div class="clear"></div>

            <div id="footer" class="pure-u-1">
                <div class="footer-bar"></div>
                <div id="sitemap">
                    <?php
                        $a = new Area('sitemap');
                        $a->display($c);
                    ?>
<!--                       <a href="#">Home</a> |
                       <a href="#">Flickr</a> |
                       <a href="#">Messenger</a> |
                       <a href="#">Sports</a> |
                       <a href="#">Finance</a>-->
                    
                       <div id="footer-copy">
                    Copyright Hoflack David
                </div>
                </div>
                
            </div>
        </div>
        <?php Loader::element('footer_required'); ?>
    </body>
</html>
