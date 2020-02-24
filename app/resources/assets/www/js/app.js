var PbSite = {

    init: function () {
        //PbSite.initAuth();
        PbSite.initVideo();
        PbSite.initSignUp();
        PbSite.initBackToTop();
    },

    initBackToTop: function () {

        var $window = $(window);
        var $toTop = $('.to-top');
        if ($toTop.length) {
            function checkBackToTop() {
                if ($window.scrollTop() > $window.height()) {
                    $toTop.fadeIn();
                } else {
                    $toTop.fadeOut();
                }
            }

            checkBackToTop();
            $window.on('scroll', checkBackToTop);
        }
    },

    initSignUp: function () {

        var $modal = $('.app-modal-signup');
        var $form = $('#SignupForm');
        var $footer = $modal.find('.modal-footer');

        var $submitBtn = $('.js-form-signup-submit');
        var originalBtnLabel = $submitBtn.html();

        $modal.on('click', '.js-form-signup-submit', function (e) {

            e.preventDefault();

            $submitBtn
                .prop('disabled', true)
                .html('<span class="icon icon-cw icon-spin"></span> GREAT! JUST A MOMENT')
            ;

            $('.js-signup-error').remove();

            $.post($form.attr('action'), $form.serialize())
                .done(function (data) {
                    $form.before('<div class="lead alert alert-success m-b-0 js-signup-success">' + data.message + '</div>');
                    $form.addClass('hidden');
                    $footer.removeClass('hidden');
                })
                .fail(function (jqXHR) {
                    //console.log(data);
                    $form.before('<div class="lead alert alert-danger js-signup-error">' + jqXHR.responseJSON.message + '</div>');
                    $submitBtn
                        .html(originalBtnLabel)
                        .prop('disabled', false)
                    ;
                });

        });

        function resetSignUpForm(){
            $('.js-signup-error').remove();
            $('.js-signup-success').remove();
            $footer.addClass('hidden');
            $submitBtn
                .html(originalBtnLabel)
                .prop('disabled', false);
            $form[0].reset();
            $form.removeClass('hidden');
        }

        $modal.on('click', '.js-form-signup-reset', function(e){
            e.preventDefault();
            resetSignUpForm();
        });

        // On hide event unset src to stop playback
        $modal.on('hidden.bs.modal', function () {
            resetSignUpForm();
        });

    },

    initVideo: function () {

        var $promoVideoModal = $('.app-modal-video');

        // On show event set the video src based on data attribute
        $promoVideoModal.on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var videoSrc = 'https://www.youtube-nocookie.com/embed/' + button.data('videoId') + '?rel=0&amp;showinfo=0';
            var modal = $(this);
            modal.find('iframe').attr('src', videoSrc);
        });

        // On hide event unset src to stop playback
        $promoVideoModal.on('hidden.bs.modal', function () {
            var modal = $(this);
            modal.find('iframe').removeAttr('src');
        });

    },

    initAuth: function () {

        var $authForm = $('#AuthForm');

        if ($authForm.size()) {

            function showLoginDialog() {
                $('.app-modal-login').modal({show: true});
                /*if($authForm.size()){
                 BootstrapDialog.show({
                 title: "Login",
                 type: BootstrapDialog.TYPE_DEFAULT,
                 size: BootstrapDialog.SIZE_SMALL,
                 message: $authForm,
                 nl2br: false,
                 cssClass: 'auth-dialog',
                 buttons: [],
                 autodestroy: false
                 });
                 }*/
            }

            if ($authForm.is('.hidden')) {
                $authForm.detach().removeClass('hidden');
            }

            $authForm.on('click', '.auth-login-btn', function (e) {
                $authForm.find('.auth-inputs').addClass('hidden');
                $authForm.find('.register-extra').addClass('hidden');
                $authForm.find('.email-extra').addClass('hidden');
                $authForm.find('.login-extra').removeClass('hidden');
                $authForm.attr('action', '/auth/login');
                $authForm.find(':submit').text('Login');
                $('.auth-dialog .bootstrap-dialog-title').text('Login');
                return false;
            }).on('click', '.auth-register-btn', function (e) {
                $authForm.find('.auth-inputs').removeClass('hidden');
                $authForm.find('.login-extra').addClass('hidden');
                $authForm.find('.email-extra').addClass('hidden');
                $authForm.find('.register-extra').removeClass('hidden');
                $authForm.attr('action', '/auth/register');
                $authForm.find(':submit').text('Register');
                $('.auth-dialog .bootstrap-dialog-title').text('Create an Account');
                return false;
            }).on('click', '.btn-social-email', function (e) {
                $authForm.find('.auth-inputs').removeClass('hidden');
                $authForm.find('.register-extra').addClass('hidden');
                $authForm.find('.email-extra').removeClass('hidden');
                $authForm.find('.login-extra').addClass('hidden');
                return false;
            });

            $('.btn-auth').on('click', function (e) {
                showLoginDialog();
                return false;
            });

            $('.confirm-login').on('click', function (e) {
                if (!authStatus) {
                    showLoginDialog();
                    return false;
                }
            });

        }

    }

};

$(document).ready(function () {
    PbSite.init();
});