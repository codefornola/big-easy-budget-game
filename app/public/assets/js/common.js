// mobile friendly "click" response time
var attachFastClick = Origami.fastclick;
attachFastClick(document.body);

var $authForm = $('#AuthForm');
if($authForm.is('.hidden')){
    $authForm.detach().removeClass('hidden');
}

$authForm.on('click', '.auth-login-btn', function(e){
    $authForm.find('.auth-inputs').addClass('hidden');
    $authForm.find('.register-extra').addClass('hidden');
    $authForm.find('.email-extra').addClass('hidden');
    $authForm.find('.login-extra').removeClass('hidden');
    $authForm.attr('action', '/auth/login');
    $authForm.find(':submit').text('Login');
    $('.auth-dialog .bootstrap-dialog-title').text('Login');
    return false;
}).on('click', '.auth-register-btn', function(e){
    $authForm.find('.auth-inputs').removeClass('hidden');
    $authForm.find('.login-extra').addClass('hidden');
    $authForm.find('.email-extra').addClass('hidden');
    $authForm.find('.register-extra').removeClass('hidden');
    $authForm.attr('action', '/auth/register');
    $authForm.find(':submit').text('Register');
    $('.auth-dialog .bootstrap-dialog-title').text('Create an Account');
    return false;
}).on('click', '.btn-social-email', function(e){
    $authForm.find('.auth-inputs').removeClass('hidden');
    $authForm.find('.register-extra').addClass('hidden');
    $authForm.find('.email-extra').removeClass('hidden');
    $authForm.find('.login-extra').addClass('hidden');
    return false;
});

$('.btn-auth').on('click', function(e){
    showLoginDialog();
    return false;
});

$('.confirm-login').on('click', function(e){
    if(!authStatus){
        showLoginDialog();
        return false;
    }
});

function showLoginDialog(){
    if($authForm.size()){
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
    }
}

var $budgetList = $('#BudgetListModal');
if($budgetList.is('.hidden')){
    $budgetList.detach().removeClass('hidden');
}


$('.js-play-budget').on('click', function(e){
    var budgetNum = $budgetList.find('.budget-link').size();
    if(budgetNum > 1){
        showBudgetList();
        return false;
    }
});

function showBudgetList(){
    if($budgetList.size()){
        BootstrapDialog.show({
            title: "Select a Budget",
            type: BootstrapDialog.TYPE_DEFAULT,
            size: BootstrapDialog.SIZE_SMALL,
            message: $budgetList,
            nl2br: false,
            cssClass: 'auth-dialog',
            buttons: [],
            autodestroy: false
        });
    }
}

$(".social-share-icons").jsSocials({
    url: "https://"+PB_ACCOUNT+".peoplesbudget.com",
    text: "Be Mayor for a Day @ People's Budget",
    showLabel: false,
    showCount: false,
    shares: ["twitter", "facebook", "googleplus", "linkedin", "pinterest", "whatsapp"]
});