function imageUploader() {
    var $dropzone = $('.image_picker'),
        $dropinput = $('.inputFile'),
        $remover = $('[data-action="remove_current_image"]'),
        $inputclick = $('[data-action="choose_from_uploaded"]');

    $dropzone.on('dragover', function () {
        $(this).find('.drop_target').addClass('dropping');
        return false;
    });

    $dropzone.on('dragend dragleave', function () {
        $(this).find('.drop_target').removeClass('dropping');
        return false;
    });

    $dropzone.on('drop', function (e) {
        var dropzone = $(this);

        dropzone.find('.drop_target').removeClass('dropping');
        dropzone.find('.drop_target').addClass('dropped');
        dropzone.find('[data-action="remove_current_image"]').removeClass('disabled');
        e.preventDefault();

        var file = e.originalEvent.dataTransfer.files[0],
            reader = new FileReader();

        reader.onload = function (event) {
            dropzone.find('.image_preview').css('background-image', 'url(' + event.target.result + ')');
            dropzone.find('.image_title').text(file.name);
        };

        // console.log(file);
        reader.readAsDataURL(file);
        dropzone.find('.inputFile').prop("files", e.originalEvent.dataTransfer.files);

        return false;
    });

    $dropinput.change(function (e) {
        var dropinput = $(this);

        dropinput.parents('.image_picker').find('.drop_target').addClass('dropped');
        dropinput.parents('.image_picker').find('[data-action="remove_current_image"]').removeClass('disabled');
        dropinput.parents('.image_picker').find('.image_title').text('');
        
        var file = dropinput.get(0).files[0],
            reader = new FileReader();

        reader.onload = function (event) {
            dropinput.parents('.image_picker').find('.image_preview').css('background-image', 'url(' + event.target.result + ')');
            dropinput.parents('.image_picker').find('.image_title').text(file.name);
        }

        reader.readAsDataURL(file);
    });

    $remover.on('click', function () {
        $(this).parents('.image_picker').find('.image_preview').css('background-image', '');
        $(this).parents('.image_picker').find('.drop_target').removeClass('dropped');
        $(this).parents('.image_picker').find('[data-action="remove_current_image"]').addClass('disabled');
        $(this).parents('.image_picker').find('.image_title').text('');
    });

    $inputclick.on('click', function(){
        $(this).parents('.image_picker').find('.inputFile').click();
    });
}