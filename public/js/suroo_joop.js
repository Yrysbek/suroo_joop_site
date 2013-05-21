$(document).ready(function(){
    /**
     * create, edit, delete sj + forms
     */
    $(document).on('click', '#create_suroo_link', function(e){
        e.preventDefault();
        $('#create_suroo_joop_form').slideDown().html('<img src="/public/img/ajax-loader.gif">')
        $.post('/suroojoop/create_suroo_joop_form',{}, function(data){
            $('#create_suroo_joop_form').html(data).slideDown().addClass('div-create-suroo-joop-form');
        })
    })

    $(document).on('click', '.sj_edit_link', function(e){

        e.preventDefault();
        var id = $(this).attr('sj_id');
        $('#create_suroo_joop_form').slideDown().html('<img src="/public/img/ajax-loader.gif">')
        $.post('/suroojoop/edit_suroo_joop_form',{id : id}, function(data){
            $('#create_suroo_joop_form').html(data).slideDown().addClass('div-create-suroo-joop-form');
            $('html, body').animate({
                "scrollTop": $('#create_suroo_joop_form').offset().top
            }, 500, "swing");
            return false;
        })
    })

    $(document).on('click', '.sj_delete_link', function(e){

        e.preventDefault();
        if(confirm('Жок кыласызбы?'))
        {
            var id = $(this).attr('sj_id');
            var search_by_word = $('input[name="search_by_word"]').val();
            var show_all = ($('input[name="show_all"]').is(':checked'))? 1:0;
            var search_by_bolum = $('select[name="search_by_bolum"]').val();
            if($.trim(search_by_word) == '' || $.trim(search_by_word) == 'Сөзү боюнча' || $.trim(search_by_word) == 'По ключевому слову')
            {
                if($('input[name="language"]').val() == 'ru')
                    $('input[name="search_by_word"]').addClass('transparent').val('По ключевому слову');
                else
                    $('input[name="search_by_word"]').addClass('transparent').val('Сөзү боюнча');
                search_by_word = '%';
            }
            if($.trim(search_by_bolum) == '')
            {
                search_by_bolum = ''
            }

            $('#create_suroo_joop_form').slideDown().html('<img src="/public/img/ajax-loader.gif">')
            $.post('/suroojoop/delete_suroo_joop',{id : id}, function(answer_data){
                $('#create_suroo_joop_form').slideUp()
                $.post('/suroojoop/list_of_suroo_joop', {word : search_by_word, bolum: search_by_bolum, show_all: show_all}, function(data){
                    $('#suroo_joop_content').html(data);

                })
            })
        }
    })

    $(document).on('click', '#create_suroo_form_cancel_link', function(e){
        e.preventDefault();
        var $this = $('#create_suroo_joop_form');
        if(confirm('Форманы жабуу керекпи?'))
        $('#create_suroo_joop_form').slideUp(500, function()
        {
            $this.removeClass('div-create-suroo-joop-form');
        });
    })

    $(document).on('submit', 'form[name="create_new_sj_form"]', function(e){
        e.preventDefault();
        var sj_new_suroo = nl2br($('textarea[name="sj_new_suroo"]').val());
        var sj_new_joop  = nl2br($('textarea[name="sj_new_joop"]').val());
        var sj_new_bolum_id  = $('select[name="sj_new_bolum_id"]').val();

        if($.trim(sj_new_suroo) == '' || $.trim(sj_new_joop) == '')
        {
            alert('Суроону, жоопту жазуу керек!');
            return false;
        }
        $.post('/suroojoop/create_suroo', {suroo : sj_new_suroo, joop : sj_new_joop, bolum_id : sj_new_bolum_id}, function(answer){
            if(answer == 'ok')
            {
                $('#suroo_joop_content').slideDown().html('<img src="/public/img/ajax-loader.gif">')
                $.post('/suroojoop/list_of_suroo_joop', {}, function(data){
                    $('#suroo_joop_content').html(data);
                    $('textarea[name="sj_new_suroo"]').val('');
                    $('textarea[name="sj_new_joop"]').val('');
                })
            }
            else
            {
                alert(data);
            }
        })
    })

    $(document).on('submit', 'form[name="edit_sj_form"]', function(e){
        e.preventDefault();
        var id = $(this).attr('suroo_id');
        var sj_suroo = nl2br($('textarea[name="sj_new_suroo"]').val());
        var sj_joop  = nl2br($('textarea[name="sj_new_joop"]').val());
        var sj_bolum_id  = $('select[name="sj_new_bolum_id"]').val();
        var interval;

        var search_by_word = $('input[name="search_by_word"]').val();
        var show_all = ($('input[name="show_all"]').is(':checked'))? 1:0;
        var search_by_bolum = $('select[name="search_by_bolum"]').val();
        if($.trim(search_by_word) == '' || $.trim(search_by_word) == 'Сөзү боюнча' || $.trim(search_by_word) == 'По ключевому слову')
        {
            if($('input[name="language"]').val() == 'ru')
                $('input[name="search_by_word"]').addClass('transparent').val('По ключевому слову');
            else
                $('input[name="search_by_word"]').addClass('transparent').val('Сөзү боюнча');
            search_by_word = '%';
        }
        if($.trim(search_by_bolum) == '')
        {
            search_by_bolum = ''
        }

        if($.trim(sj_suroo) == '' || $.trim(sj_joop) == '')
        {
            alert('Суроону, жоопту жазуу керек!');
            return false;
        }
        $.post('/suroojoop/edit_suroo', {suroo : sj_suroo, joop : sj_joop, bolum_id : sj_bolum_id, id : id}, function(answer){
            if(answer == 'ok')
            {
                $('#suroo_joop_content').slideDown().html('<img src="/public/img/ajax-loader.gif">')
                $.post('/suroojoop/list_of_suroo_joop', {word : search_by_word, bolum: search_by_bolum, show_all: show_all}, function(data){
                    $('#suroo_joop_content').html(data);
                    $('#create_suroo_joop_form').slideUp(0);
                        interval = setInterval(function() {
                            if ($('.suroo_element_'+id).length > 0)
                            {
                                clearInterval(interval);
                                $('html, body').animate({
                                    "scrollTop": $('.suroo_element_'+id).offset().top
                                }, 500, "swing");
                            }
                        }, 520);
                    return false;
                })
            }
            else
            {
                alert(data);
            }
        })
    })

    $(document).on('click', '.edit_sj_link', function(e){
        e.preventDefault();
        var sj_id = $(this).attr('sj_id');
    })

    $(document).on('click', '#bolumdor_link', function(e){
        e.preventDefault();
        $('#create_suroo_joop_form').slideDown().html('<img src="/public/img/ajax-loader.gif">')
        $.post('/suroojoop/bolumdor_form',{}, function(data){
            $('#create_suroo_joop_form').html(data).slideDown().addClass('div-create-suroo-joop-form');
        })
    })

    $(document).on('click', '#create_bolum_button', function(e){
        e.preventDefault();
        var value = $('input[name="new_bolum"]').val();
        if($.trim(value) == '')
        {
            alert('noting to create!');
            return false;
        }
        $.post('/suroojoop/create_bolum', {bolum : value}, function(answer){
            if(answer == 'ok')
            {
                $('#bolumdor_link').click();
                $('#createbolum').slideUp()
            }
            else
            {
                alert(answer);
            }
        })
    })

    $(document).on('click', '.bolum-delete-link', function(e){

        e.preventDefault();
        if($('.selected-bolum-div').length == 0)
        {
            alert('Биринчи болум танданыз, анан жок ылуу мумкун!');
            return false;
        }
        if(confirm('Уверены что хотите удалить этот раздел?'))
        {
            if($('.selected-bolum-div').attr('bolum-id'))
            {
                $.post('/suroojoop/delete_bolum', {id : $('.selected-bolum-div').attr('bolum-id')}, function(answer){
                    if(answer == 'ok')
                    {
                        $('#bolumdor_link').click();
                    }
                    else
                    {
                        alert(answer);
                    }
                });
            }
        }
    })

    $(document).on('click', '.bolum-create-link', function(e){

        e.preventDefault();
        $('#createbolum').slideDown().html('<span style="padding: 3px">Жаны болум аты: <input type="text" name="new_bolum"><button id="create_bolum_button">Жаңы</button></span>')
    })

    $(document).on('click', '.bolum-div', function(e){
        e.preventDefault();

        $('.bolum-div').removeClass('selected-bolum-div');
        $(this).addClass('selected-bolum-div');
    })

    $(document).on('dblclick', '.bolum-edit-link,.bolum-div', function(e){
        e.preventDefault();

        if($('.bolum-edit-link').hasClass('selected'))
        {
            return false;
        }


        var bolum_id = $(this).attr('bolum-id');
        var bolum_text = $('.bolum_span_'+bolum_id).text();
        $('.bolum_span_'+bolum_id).html('<input style="width: 100%; height: 100%" class="edit_bolum_input" type="text" bolum-id="'+bolum_id+'" value="'+bolum_text+'">');
        $('body').append('<input type="hidden" name="temp_value" value="'+bolum_text+'">');
        $('.edit_bolum_input').focus();

        $('.bolum-edit-link').addClass('selected');
    })

    $(document).on('focusout', '.edit_bolum_input', function(e){
        e.preventDefault();

        var bolum_id = $(this).attr('bolum-id');
        var value = '';
        if($.trim($('.edit_bolum_input').val()) == '')
        {
            value = $('input[name="temp_value"]').val();
        }
        else
        {
            value = $('.edit_bolum_input').val();
        }
        if(!check_pass())
        {
            $('.bolum_span_'+bolum_id).html(value);
            $('.bolum-edit-link').removeClass('selected');
            $('input[name="temp_value"]').remove();
            return false;
        }
        $.post('/suroojoop/edit_bolum', {bolum_id : bolum_id, bolum : value}, function(answer){
            if(answer == 'ok')
            {

            }
            else
            {
                alert(answer);
            }
        })
        $('.bolum_span_'+bolum_id).html(value);
        $('.bolum-edit-link').removeClass('selected');
        $('input[name="temp_value"]').remove();

    })

    $(document).on('focusin', 'input[name="search_by_word"]', function(e){
        if($(this).val() == 'Сөзү боюнча' || $(this).val() == 'По ключевому слову')
        {
            $(this).removeClass('transparent').val('')
        }
    })

    $(document).on('focusout', 'input[name="search_by_word"]', function(){
        switch ($.trim($('input[name="search_by_word"]').val()))
        {
            case '':
            case 'Сөзү боюнча':
            case 'По ключевому слову':
                ($('input[name="language"]').val() == 'ru')?
                    $('input[name="search_by_word"]').addClass('transparent').val('По ключевому слову')
                    : $('input[name="search_by_word"]').addClass('transparent').val('Сөзү боюнча');
                break;
        }
    })

    $(document).on('submit', 'form[name="form_search_by_word"]', function(e){
        e.preventDefault();
        var search_by_word = $.trim($('input[name="search_by_word"]').val());
        var show_all = ($('input[name="show_all"]').is(':checked'))? 1:0;
        var search_by_bolum = $.trim($('select[name="search_by_bolum"]').val());

        switch (search_by_word)
        {
            case '':
            case 'Сөзү боюнча':
            case 'По ключевому слову':
                search_by_word = '%';
                break;
        }
        $('#suroo_joop_content').slideDown().html('<img src="/public/img/ajax-loader.gif">')
        $.post('/suroojoop/list_of_suroo_joop', {word : search_by_word, bolum: search_by_bolum, show_all: show_all}, function(data){
            $('#suroo_joop_content').html(data);
            $('#search_by_word_button').css({'border': '0 none'})
            $('#howtoask').removeClass('process')
        })
    })

    $(document).on('click', '.scrollup', function(e){
        e.preventDefault();
        $("html, body").animate({ scrollTop: 0 }, 600);
        return false;
    });
    $(document).on('click', '#howtoask', function(e){
        e.preventDefault();

        if ($(this).hasClass('process')){
            return false
        }

        $(this).addClass('process');
        var example_text = new Array('орозо, каффара', 'багымдат, азан', 'нике, талак', 'истихара, түш',
                                     'бильярд, макрух', 'тамеки, даарат', 'хадис, намаз',
                                     'орозо, мисвак, гусул', 'береке', 'тазалык, ыйман',
                                     'азан, намаз, каза', 'сетевой маркетинг',
                                     ''
        )
        var math_rand = getRandomInt(0, example_text.length-1);

        var showText = function (target, message, index, interval) {
            if (index < message.length) {
                $('input[name="search_by_word"]').addClass('redborder');
                $(target).val($(target).val()+message[index++]);
                setTimeout(function () {
                    $('input[name="search_by_word"]').removeClass('redborder');
                    //$('#howtoask-img').fadeIn(0).css({'position': 'absolute', 'display': 'block'}).delay(250).fadeOut(0).css({'position': 'absolute', 'display': 'none'})
                    showText(target, message, index, interval);
                }, interval);
            }
        }

        /*$('html, body').animate({
            "scrollTop": $('#howtoask').offset().top
        }, 100, "swing");*/

        $('input[name="search_by_word"]').val('').removeClass('transparent')
        showText('input[name="search_by_word"]', example_text[math_rand], 0, 160)
        setTimeout(function(){
            $('#search_by_word_button').css({'border': '3px solid red'});
        }, example_text[math_rand].length * 160)
        setTimeout(function(){
            $('#search_by_word_button').click()
        }, example_text[math_rand].length * 170)
    })
})

$(window).scroll(function(){
    if ($(this).scrollTop() > 100) {
        $('.scrollup').fadeIn();
    } else {
        $('.scrollup').fadeOut();
    }
});

function check_pass()
{
    var password = prompt("Password?");
    if(password == 'ustaz')
        return true;
    else
        return false;
}

function nl2br (str) {
    return str.replace(/([^>])\n/g, '$1<br/>');
}

function getRandomInt(min, max)
{
    return Math.floor(Math.random() * (max - min + 1)) + min;
}
