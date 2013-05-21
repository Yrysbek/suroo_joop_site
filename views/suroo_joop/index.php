<div>
    <span id="count_online_users"><?=$this->data['ou_count'];?></span> колдонуучу <span style="color: green; font: bold">онлайн</span>
</div>
<a href="" id="howtoask" style="font-size: 0.8em; font-weight: bold; text-decoration: underline">Кантип издөө керек?</a><br />
<?php if(isset($this->data['user_id'])):?>
<p>
    Кош келдиңиз, <?=$this->data['username'];?><br/>
    <a href="/admin" style="color: blue; text-decoration: underline">Admin page</a>
</p>
<?php endif;?>
<a href="#" class="scrollup">Scroll</a>
<p style="display: inline; text-decoration: underline">
    <?php if($this->data['language'] == 'kg'):?>
    Суроо-жооптон издөө:
    <?php elseif($this->data['language'] == 'ru'):?>
    Поиск в вопросах и ответах
    <?php endif;?>
</p>
<form style="display: inline" name="form_search_by_word">
    <?php if($this->data['language'] == 'kg'):?>
        <input name="search_by_word" class="transparent keyboardInput inputBlock" size="21" value="Сөзү боюнча">
    <?php elseif($this->data['language'] == 'ru'):?>
        <input name="search_by_word" class="transparent keyboardInput inputBlock" size="21" value="По ключевому слову">
    <?php endif;?>
    <input name="language" type="hidden" value="<?=$this->data['language']?>">
    <select name="search_by_bolum" class="selectBlock">
        <?php if($this->data['language'] == 'kg'):?>
            <option value="all">Темасы боюнча</option>
        <?php elseif($this->data['language'] == 'ru'):?>
            <option value="all">По теме</option>
        <?php endif;?>.
        <?php foreach($this->bolumdor as $bolum):?>
            <option value="<?=$bolum['id'];?>"><?=$bolum['bolum'];?></option>
        <?php endforeach; ?>
    </select>
    <input type="checkbox" name="show_all">Баары
    <input type="submit" id="search_by_word_button" class="imgClass" value="">
</form>
    <?php if($this->data['is_admin']):?>
    <u>
        <br><a href="#" id="create_suroo_link">Жаңы суроо-жооп жазуу</a><br>
        <a href="#" id="bolumdor_link">Бөлүмдөрдү редакциялоо</a>
        <br/>
    </u>
    <?php endif;?>


<div id="create_suroo_joop_form"></div>
<div id="suroo_joop_content" class=""></div>

<script>
    $(document).ready(function(){
        $('.item_suroojoop').css('background-color', '#2e4aab');
        $('.item').hover(function(){
            $('.item').css('background-color', 'transparent');
        })
        $('.item').on('mouseout', function(){
            $('.item_suroojoop').css('background-color', '#2e4aab');
        })
        $('#suroo_joop_content').html('<img src="/public/img/ajax-loader.gif">')
        $.post('/suroojoop/list_of_suroo_joop', {}, function(data){
            $('#suroo_joop_content').html(data);
        })

        /*$('.selectBlock').sSelect();*/
    })
</script>