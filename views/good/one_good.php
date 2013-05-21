<?php
if($this->data['goods']):
    foreach($this->data['goods'] as $good):
?>
<div class="good-div">
    <p><?=$good['name']?></p>
    <img src="<?=$good['image']?>" title="<?=$good['image_title']?>">
    <abbr><?=$good['description']?></abbr>
    <p>
        <?=$good['price']?> сом
    </p>
    <p>Всего: <?=$good['total_count']?> шт.</p>
</div>
<?php endforeach; ?>
<?php endif;?>