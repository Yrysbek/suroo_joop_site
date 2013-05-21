<!DOCTYPE html>
<html>
    <head>
        <title>Чубак устаздын сабактары, суроо-жоортору боюнча сайт</title>
        <link rel="stylesheet" href="/public/css/default.css">
        <link rel="stylesheet" href="/public/css/keyboard.css">
        <link rel="stylesheet" href="/public/css/suroo_joop.css">
        <link rel="stylesheet" href="/public/css/good.css">
        <link rel="stylesheet" href="/public/css/fineuploader-3.5.0.css">
        <!--<link rel="stylesheet" href="/public/css/days/stylesheet.css">-->
        <script type="text/javascript" src="/public/js/jquery.js"></script>
        <script type="text/javascript" src="/public/js/plugins/jquery.parallax.js"></script>
        <script type="text/javascript" src="/public/js/general.js"></script>
        <script type="text/javascript" src="/public/js/suroo_joop.js"></script>
        <script type="text/javascript" src="/public/js/keyboard.js"></script>
        <script type="text/javascript" src="/public/js/good.js"></script>
        <script type="text/javascript" src="/public/js/plugins/fineuploader/jquery.fineuploader-3.5.0.min.js"></script>
        <!--<script type="text/javascript" src="/public/js/select.js"></script>-->
        <script type="text/javascript" src="/public/js/plugins/galleria/galleria-1.2.9.min.js"></script>
        <script>
            Galleria.loadTheme('/public/js/plugins/galleria/themes/classic/galleria.classic.min.js');
        </script>
        <script>
            jQuery(document).ready(function(){
                jQuery('#parallax .parallax-layer')
                    .parallax({
                        mouseport: jQuery('#parallax')
                    });
            });
        </script>
    </head>
    <body>
    <?php
    /*$first_img_right = rand(-790, 230);*/?><!--
            <?php /*$first_img_top = rand(-30, 250);*/?>
            <?php /*$second_img_left = rand(-100, 680);*/?>
            <?php /*$second_img_top = rand(-150, 150);*/?>
            <?php /*$third_img_left = rand(-300, 860);*/?>
            <?php /*$third_img_top = rand(-260, 20);*/?>
            <div class="parallax-layer" style="width:600px; height:300px;">
                <img src="/public/img/2.png" alt="" style="position: absolute; right: <?/*=$first_img_right*/?>px; top: <?/*=$first_img_top*/?>px;" />
            </div>
            <div class="parallax-layer" style="width:500px; height:280px;">
                <img src="/public/img/3.png" alt="" style="position: absolute; left: <?/*=$second_img_left*/?>px; top: <?/*=$second_img_top*/?>px;" />
            </div>
            <div class="parallax-layer" style="width:400px; height:250px;">
                <img src="/public/img/4.png" alt="" style="position: absolute; left: <?/*=$third_img_left*/?>px; top: <?=$third_img_top?>px;"/>
            </div>-->
    <div lang="kg" class="lang_kg"></div>
    <div lang="ru" class="lang_ru"></div>
    <?php if(rand(0,1)):?>
        <div id="header">
        </div>
    <?php else: ?>
        <div class="site_wrap">
            <div class="parallax-viewport" id="parallax">
                <!-- слои parallax  -->
                <div class="parallax-layer" style="width:600px; height:300px;">
                    <img src="/public/img/2.png" alt="" style="top: 30px; z-index: 1" />
                </div>
                <div class="parallax-layer" style="width:500px; height:280px;">
                    <img src="/public/img/3.png" alt="" style="left: -20px; position: absolute; top:10px;" />
                </div>
                <div class="parallax-layer" style="width:400px; height:250px;">
                    <img src="/public/img/4.png" alt="" style="left: -30px; position: absolute; top: -35px;"/>
                </div>
            </div>
        </div>
    <?php endif; ?>
        <div id="nav">
            <ul class="menu">
                <?php if($this->data['language'] == 'kg'):?>
                    <li class="item item_aboutsite">
                        <a class="default_link_header" href="/index">Сайт жөнүндө</a>
                    </li>
                    <li class="item item_suroojoop">
                        <a href="/suroojoop">Суроо-Жооп баракчасы</a>
                    </li>
                    <li class="item item_aboutustaz">
                        <a href="/index/ustaz">Чубак устаз жөнүндө</a>
                    </li>
                <?php elseif($this->data['language'] == 'ru'):?>
                    <li class="item item_aboutsite">
                        <a class="default_link_header" href="/index">О сайте</a>
                    </li>
                    <li class="item item_suroojoop">
                        <a href="/suroojoop">Страница вопросов-ответов</a>
                    </li>
                    <li class="item item_aboutustaz">
                        <a href="/index/ustaz">О Чубак устазе</a>
                    </li>
                <?php endif;?>
            </ul>
        </div>
        <div id="content">
            <div id="left_menu">