<div class="good-main">
    <a href="" id="good-create-form-link">create</a>
</div>
<div class="goods-main-container">
<div id="filter">
    <a href="" filter="all">All</a>
</div>
<div id="good-list"></div>
</div>
<form id="good-create-form" style="display: none">
    <div class="good-create-div">
        <p>New good form</p>
        <table style="width: 93%">
            <tbody>
            <tr>
                <td>
                    Name<!--<span class="big-red-star">*</span>-->
                </td>
                <td>
                    <input name="good_name" class="full-wo-border">
                </td>
            <tr>
            <tr>
                <td>
                    Description
                </td>
                <td>
                    <textarea rows="7" name="good_description" class="full-wo-border"></textarea>
                </td>
            <tr>
            <tr>
                <td>
                    Type<!--<span class="big-red-star">*</span>-->
                </td>
                <td>
                    <select name="good_type_id" class="full-wo-border">
                        <option selected="selected" value="1">Неотсортированные</option>
                    </select>
                </td>
            <tr>
            <tr>
                <td>
                    Image
                </td>
                <td style="text-align: left">
                    <img id="good-create-image-preview" src="/public/img/default-good1.jpg" height="100px" width="160px">
                    <span class="good-image-change-title">
                        change
                    </span>
                    <input name="good_image" type="hidden" value="/public/img/default-good1.jpg">
                    <div id="fine-uploader" style="display: none"></div>
                </td>
            <tr>
            <tr>
                <td>
                    Image-title<!--<span class="big-red-star">*</span>-->
                </td>
                <td>
                    <input name="good_image_title" class="full-wo-border">
                </td>
            <tr>
            <tr>
                <td>
                    Price<!--<span class="big-red-star">*</span>-->
                </td>
                <td>
                    <input name="good_price" type="text" class="full-wo-border">
                </td>
            <tr>
            <tr>
                <td>
                    Total count<!--<span class="big-red-star">*</span>-->
                </td>
                <td>
                    <input name="good_total_count" type="text" class="full-wo-border">
                </td>
            <tr>
            </tbody>
            <tfoot>
            <tr>
                <td colspan="2">
                    <div  style="left: 35%; position: absolute;">
                        <input type="submit" value="Create" id="good-create-form-submit">
                        <button id="good-cancel-create-form">Cancel</button>
                    </div>
                </td>
            <tr>
            </tfoot>
        </table>
    </div>
</form>

<script>
$(document).ready(function(){
    //$('#good-create-form-link').click()

    var default_image = $('#good-create-image-preview').attr('src')
    var uploader = new qq.FineUploader({
        element: $('#fine-uploader')[0],
        text: {
            uploadButton: 'Upload image'
        },
        validation :{
            allowedExtensions: ['jpeg', 'jpg', 'gif', 'png'],
            sizeLimit: 2097152 // 2 Mb = 2 * 1024 * 1024 bytes
        },
        request: {
            endpoint: '/good/handleUpload'
        },
        callbacks: {
            onProgress: function(){
                $('#good-create-image-preview').attr('src', '/public/img/processing.gif')
            },
            onComplete: function(id, fileName, responseJSON) {
                if (responseJSON.success){
                    $('#good-create-image-preview').attr('src', '/'+responseJSON.filename)
                    $('input[name="good_image"]').val('/'+responseJSON.filename)
                }
                else{
                    $('#good-create-image-preview').attr('src', default_image);
                }

            }
        }
    });
})
</script>