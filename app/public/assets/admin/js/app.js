$(document).ready(function () {

    $('.main-sidebar,.content').on('click', '.confirmable', function (e) {
        e.preventDefault();
        var $link = $(this);
        BootstrapDialog.confirm({
            title: 'Please confirm',
            message: 'Are you sure you want to continue?',
            type: BootstrapDialog.TYPE_DEFAULT,
            btnOKLabel: 'Yes',
            //btnOKClass: 'btn-default',
            btnCancelLabel: 'Cancel',
            callback: function(result) {
                if (result) {
                    window.location = $link.attr('href');
                    return true;
                }
            }
        });

    });

    // Forms with file inputs styled shoudl provide feedback
    $('.content').on('change', '.btn-file :file', function() {
        var input = $(this),
            numFiles = input.get(0).files ? input.get(0).files.length : 1,
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [numFiles, label]);
    });

    $('.btn-file :file').on('fileselect', function(event, numFiles, label) {
        var input = $(this).parents('.input-group').find(':text'),
            log = numFiles > 1 ? numFiles + ' files selected' : label;

        if (input.length) {
            input.val(log);
        } else {
            if (log) alert(log);
        }
    });

})