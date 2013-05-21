
<form name="edit_sj_form" suroo_id="<?=$this->data['id']?>">
    <table>
        <tr>
            <td>
                Суроо:
            </td>
            <td>
                <textarea cols="90" rows="10" name="sj_new_suroo"><?=stripslashes(htmlspecialchars_decode(nl2br(str_replace('\n', '<br />',$this->data['suroo']))));?></textarea>
            </td>
        </tr>
        <tr>
            <td>
                Жооп:
            </td>
            <td>
                <textarea cols="90" rows="10" name="sj_new_joop"><?=stripslashes(htmlspecialchars_decode(nl2br(str_replace('\n', '<br />',$this->data['joop']))))?></textarea>
            </td>
        </tr>
        <tr>
            <td>
                Болум:
            </td>
            <td>
                <select name="sj_new_bolum_id">
                    <?php foreach($this->bolumdor as $bolum):?>
                        <option <? echo ($bolum['id'] == $this->data['bolum_id'])? 'selected="selected"' : ''; ?> value="<?=$bolum['id']?>"><?=$bolum['bolum']?></option>
                    <?php endforeach;?>
                </select>
            </td>
        </tr>
        <tr>
            <td>
                <input type="submit">
            </td>
            <td>
                <button id="create_suroo_form_cancel_link">Кайтар</button>
            </td>
        </tr>
    </table>
</form>