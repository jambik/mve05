$(document).ready(function() {

    if ($('#form_callback').length) {
        $('#form_callback').on('submit', function(e){
            ajaxFormSubmit(e, callbackSuccess);
        })
    }

    if ($('.popup-gallery').length) {
        $('.popup-gallery').magnificPopup({
            type: 'image',
            zoom: {
                enabled: true
            },
            gallery: {
                enabled: true,
                preload: [1, 2],
                tPrev: 'Пердыдущая (клавиша влево)',
                tNext: 'Следующая (клавиша вправо)'
            },
            tLoading: 'Загрузка...'
        });
    }

    if ($('.popup-product').length) {
        $('.popup-product').magnificPopup({
            type: 'image',
            zoom: {
                enabled: true
            },
            tLoading: 'Загрузка...'
        });
    }

});

function ajaxFormSubmit(e, successFunction)
{
    e.preventDefault();

    var form = e.target;

    // Место для отображения ошибок в форме
    var formStatus = $(form).find('.form-status');
    if (formStatus.length) {
        formStatus.html('');
    }

    // Анимированная кнопка при отправки формы
    var formButton = $(form).find('.form-button');
    if (formButton.length) {
        formButton.append(' <i class="fa fa-spinner fa-spin"></i>');
        formButton.prop('disabled', true);
    }

    $.ajax({
        method: $(form).attr('method'),
        url: $(form).attr('action'),
        data: $(form).serialize(),
        success: function (data)
        {
            successFunction(data);
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            if (formStatus.length && jqXHR.status == 422) // Если статус 422 (неправильные входные данные) то отображаем ошибки
            {
                var formStatusText = "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><div class='text-uppercase'>" + (formStatus.data('errorText') ? formStatus.data('errorText') : 'Ошибка!') + "</div><ul>";

                $.each(jqXHR.responseJSON, function (index, value) {
                    formStatusText += "<li>" + value + "</li>";
                });

                formStatusText += "</ul></div>";
                formStatus.html(formStatusText);
                $('body').scrollTo(formStatus, 500);
            }
            else
            {
                sweetAlert("", "Ошибка при запросе к серсеру", 'error');
            }
        },
        complete: function (jqXHR, textStatus)
        {
            if (formButton.length)
            {
                formButton.find('i').remove();
                formButton.prop('disabled', false);
            }
        }
    });
}

function callbackSuccess(data)
{
    $('#callbackModal').modal('hide');
    showNoty(data.message, 'success');
}

function showNoty(message, type)
{
    noty({
        text: message,
        type: type,
        layout: 'topCenter',
        theme: 'relax',
        timeout: 5000,
        animation: {
            open: 'animated flipInX', // jQuery animate function property object
            close: 'animated flipOutX', // jQuery animate function property object
            easing: 'swing', // easing
            speed: 500 // opening & closing animation speed
        }
    });
}

function avatarSelected()
{
    startCropper($('#avatar_file')[0].files[0]);

    $('#avatar_cropper').show();
    $('#avatar_current').hide();
}

function startCropper(file)
{
    var $img = $('<img src="' + URL.createObjectURL(file) + '">');
    $('#avatar_wrapper').empty().html($img);

    $img.cropper({
        aspectRatio: 1,
        preview: $('.avatar-preview').selector,
        strict: true,
        guides: false,
        crop: function (e) {
            var json = [
                '{"x":' + e.x,
                '"y":' + e.y,
                '"height":' + e.height,
                '"width":' + e.width,
                '"rotate":' + e.rotate + '}'
            ].join();
            $('#avatar_data').val(json);
        }
    });
}

function cancelAvatarUpload()
{
    URL.revokeObjectURL($('#avatar_file')[0].files[0].url); // Revoke the old one

    $('#avatar_cropper').hide();
    $('#avatar_current').show();
}