<form name="create_new_sj_form">
    <table>
        <!--<caption>Жаны суроо</caption>-->
        <tr>
            <td>
                Суроо:
            </td>
            <td>
                <textarea cols="90" rows="10" name="sj_new_suroo"></textarea>
            </td>
        </tr>
        <tr>
            <td>
                Жооп:
            </td>
            <td>
                <textarea cols="90" rows="10" name="sj_new_joop"></textarea>
            </td>
        </tr>
        <tr>
            <td>
                Болум:
            </td>
            <td>
                <select name="sj_new_bolum_id">
                    <?php foreach($this->bolumdor as $bolum):?>
                        <option <?php echo ($bolum['id'] == 2)?'selected="selected"':'';?> value="<?=$bolum['id']?>"><?=$bolum['bolum']?></option>
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