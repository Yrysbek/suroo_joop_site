<?php if($this->data['language'] == 'kg'):?>
<b>Устаздын youtube-дагы сабактары</b>
<?php elseif($this->data['language'] == 'ru'):?>
<b>Уроки с youtube</b>
<?php endif;?>
<?php
$videos = array();
$i = 0;
?>
<div id="galleria">
    <?php foreach($this->data['images'] as $image):?>
        <?php
            parse_str(parse_url($image, PHP_URL_QUERY ), $my_array_of_vars);
        if(!empty($my_array_of_vars['v']))
        {
            $videos[$i]['thumb']    = 'http://img.youtube.com/vi/'.$my_array_of_vars['v'].'/1.jpg';
            $videos[$i]['iframe']   = 'http://www.youtube.com/embed/'.$my_array_of_vars['v'].'?wmode=opaque';
            ++$i;
        }
        ?>
    <? endforeach;?>
</div>
<div id="gallery_fullscreen"><img id="gallery_fullscreen_img" src="/public/img/Fullscreen-32.png"/></div>
<script>
    // Initialize Galleria
    Galleria.run('#galleria', {dataSource: <?=json_encode($videos)?>}, function(){

        var gallery = this;

        $('#gallery_fullscreen').click(function(e){
            e.preventDefault();
            gallery.toggleFullscreen();
        })

    });
</script>