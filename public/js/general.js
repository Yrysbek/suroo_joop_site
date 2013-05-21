$(document).ready(function(){
    $(document).on('click', '.lang_kg', function(e){
        $.post('/index/change_language', {lang : $(this).attr('lang')}, function(data)
        {
            if(data == 'ok')
            {
                location.reload();
            }
        })
    })
    $(document).on('click', '.lang_ru', function(e){
        $.post('/index/change_language', {lang : $(this).attr('lang')}, function(data)
        {
            if(data == 'ok')
            {
                location.reload();
            }
        })
    })
})