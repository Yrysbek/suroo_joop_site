/**
 * Created with JetBrains PhpStorm.
 * User: Windows95
 * Date: 12.05.13
 * Time: 13:13
 * To change this template use File | Settings | File Templates.
 */
$(document).on('click', '#good-create-form-link', function(e){_(e)
    $('#good-create-form-link').slideUp()
    $('#good-create-form').slideDown(function(){
        $('html, body').animate({
            "scrollTop": $('#good-create-form').offset().top
        }, 10, "swing");
    })

})
$(document).on('click', '#good-cancel-create-form', function(e){_(e)
    $('#good-create-form-link').slideDown()
    $('#good-create-form').slideUp();
})
$(document).on('click', '#good-create-image-preview,.good-image-change-title', function(e){_(e)
    $('div#fine-uploader input[name="file"]').click();
})

$(document).on('mouseover', '#good-create-image-preview,.good-image-change-title', function(){
    $('.good-image-change-title').css('display', 'inline-block')
})

$(document).on('mouseout', '#good-create-image-preview,.good-image-change-title', function(){
    $('.good-image-change-title').css('display', 'none')
})

$(document).on('submit', 'form#good-create-form', function(e){_(e)
    $('.validation-error').removeClass('validation-error')
    var fields = $('form#good-create-form :input').toArray()
    var error = 0;

    $.each(fields, function(index, field){
        if($(field).attr('name') != undefined)
        {
            switch ($(field).attr('name'))
            {
                case 'good_name':
                case 'good_type':
                case 'good_price':
                case 'good_total_count':
                    if($(field).val() == '')
                    {
                        $('input[name="'+$(field).attr('name')+'"]').addClass('validation-error')
                        error++
                    }
                    break;
            }
        }
        else
        {
            fields.splice(index, 1)
        }
    })

    if(error){
        return false
    }

    $.ajax({
        url: '/good/create_good',
        type: 'POST',
        dataType: 'JSON',
        data: fields,
        success: function(id)
        {
            if(!isNaN(id))
                $('#filter.all').click()
        },
        error: function(data)
        {
            alert(data)
        }
    });
})

$(document).on('click', '#filter>a', function(e){_(e)
    var filter = $(this).attr('filter');
    $.post('/good/list_of_good', {filter : filter}, function(html){
        $('#good-list').html(html)
    })

})


/*************************
 *    ***EXTENDING***    *
 *         ***           *
 *    ***FUNCTIONS***    *
 *************************/
function _(e)
{
    return e.preventDefault();
}

function in_array(needle, haystack, strict)
{
    var found = false, key, strict = !!strict

    for(key in haystack)
    {
        if((strict && haystack[key] === needle) || (!strict && haystack[key] == needle))
        {
            found = true
            break
        }
    }
    return found
}

function check_if_not_empty()
{
    for(var i = 0; i < fields.length-1; i++)
    {
        alert(i +'. ' + $(fields[i]).attr('name') + ' : ' + $(fields[i]).val())
    }
}