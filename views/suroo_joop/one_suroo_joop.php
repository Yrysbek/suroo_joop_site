<?php $num = 1;?>
<?php foreach($this->data['suroo_joops'] as $suroo_joop):?>
    <div class="suroo_joop_div">
        <table>
            <tr>
                <td class="suroo_element_<?=$suroo_joop['id']?>">
                    <p style="font-size: 10px; display: inline"><?='<i>'.$num++.'. </i>'?>
                        <?php if($this->data['is_admin']):?>
                            <?=$suroo_joop['created']?>,
                        <?php endif;?>
                        <?php if($this->data['language'] == 'kg'):?>
                            Бөлүм:
                        <?php elseif($this->data['language'] == 'ru'):?>
                            Раздел:
                        <?php endif;?>
                        <?=$suroo_joop['bolum']?></p>
                    <?php if($this->data['is_admin']):?>
                    <span style="color: brown; text-align: right; vertical-align: top; display: inline; position: relative; left: 100px">
                        <a href="#" class="sj_edit_link" sj_id="<?=$suroo_joop['id']?>">edit</a>
                        <a href="#" class="sj_delete_link" sj_id="<?=$suroo_joop['id']?>">delete</a>
                    </span>
                        <span style="text-align: right; vertical-align: top; display: inline; position: relative; left: 150px">
                            киргизди: <?=$suroo_joop['admin_user']?>
                        </span>
                    <?php endif;?>
                </td>
            </tr>
            <tr>
                <td class="sj-suroo">
                    <span ><?=htmlspecialchars_decode(stripcslashes($suroo_joop['suroo']))?></span>
                </td>
            </tr>
            <tr>
                <td class="sj-joop">
                    <span><?=htmlspecialchars_decode(stripcslashes($suroo_joop['joop']))?></span>
                </td>
            </tr>
        </table>
    </div>
    <hr>
<?php endforeach; ?>
<script>
    $(document).ready(function(){
        var count_online_users = parseInt(<?=$this->data['ou_count'];?>)
        $('#count_online_users').html(count_online_users);
    })
</script>