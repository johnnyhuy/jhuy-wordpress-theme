jQuery(document).ready(function ($) {
    $('.upload-file').click(function(event) {
        event.preventDefault();

        // Create WordPress media frame.
        var frame = wp.media({
            title: 'Custom Image',
            button: {
                text: 'Upload Image'
            },
            multiple: false
        });

        // Once selected, paste src to input.
        frame.on('select', function() {
            var attachment = frame.state().get('selection').first().toJSON();
            $('.upload-file').attr('src', attachment.url);
            $('.upload-file-url').val(attachment.url);
        })
        .open();
    });
});