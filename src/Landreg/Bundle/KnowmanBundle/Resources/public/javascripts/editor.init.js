$(function() {
    $('.js-add-to-form').on('click', function() {
        $('textarea.ckeditor').each(function () {
            var textarea = $(this);
            textarea.val(CKEDITOR.instances[textarea.attr('id')].getData());
        });
    })
});