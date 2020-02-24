$(document).ready(function () {

    $('.content').on('click', '.actionable', function (e) {
        e.preventDefault();
        $btn = $(this);
        var action = $btn.data('action');
        $item = $btn.closest('.item-row');
        var method = $btn.data('method').toUpperCase();
        var params = {id: $item.data('id')};
        var $updateFill = $($btn.data('updateFill'));
        var $updateReplace = $($btn.data('updateReplace'));
        params._token = laravel_csrf_token;
        if (method != 'GET' && method != 'POST') {
            params._method = method;
            method = 'POST';
        }

        BootstrapDialog.confirm({
            title: 'Please confirm',
            message: 'Are you sure you want to continue?',
            type: BootstrapDialog.TYPE_DEFAULT,
            btnOKLabel: 'Yes',
            btnOKClass: 'btn-danger',
            btnCancelLabel: 'Cancel',
            callback: function(result) {
                if (result) {
                    $.ajax(action, {
                        type: method,
                        data: params,
                        success: function (resp) {
                            $updateReplace.size()
                                ? $updateReplace.replaceWith(resp)
                                : $updateFill.html(resp);
                        }
                    });
                }
            }
        });

    });

});