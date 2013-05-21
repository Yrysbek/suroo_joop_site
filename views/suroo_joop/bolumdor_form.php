<button class="bolum-create-link link">Жаны болум</button>
<button class="bolum-delete-link link">Жок кыл</button><br>
<div id="createbolum" style="display: none"></div>
<?php foreach($this->bolumdor as $bolum):?>
    <div class="bolum-div" bolum-id="<?=$bolum['id'];?>">
        <span class="bolum-edit-link bolum-link bolum_span_<?=$bolum['id'];?>" bolum-id="<?=$bolum['id'];?>"><?=$bolum['bolum']; ?></span>
    </div>
<?php endforeach;?>
<button id="create_suroo_form_cancel_link">Кайтар</button>