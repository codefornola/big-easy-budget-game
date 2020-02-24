(function ($) {

    $.fn.pb = function (options) {

        // "Capture" enter key press when adding divisions in the backend

        var $form      = $(this);

        var $msgBox    = $('.pb-msg-box');
        var msgTpl     = '<div class="alert alert-dismissable text-center alert-:type:">:message:</div>';
        var settings = $.extend({
            // defaults
            allowance: 100,
            requireZeroRemaining: true,
            beforeChangeBudget: function($org, delta){/* this = null */},
            beforeViewPoll: function($org, poll){/* this = null */},
            beforeViewDetails: function($org){},
            beforeFinishGame: function(){}
        }, options);
        var activeDialogs = [];

        /**
         * When checkboxes/radios checked/unchecked, toggle background color
         */
        $(document).on('click', '.radio', function () {
            var $radio = $(this);
            var $group = $radio.closest('.form-group');
            var $radios = $group.find('.radio');

            $radios.removeClass('checked');
            $radio.addClass('checked');
            $group.find('.additional-info').addClass('hide').find(':input').val('').prop('disabled', true);

            var $other = $radio.siblings('.additional-info');
            if ($other.size()) {
                $other.removeClass('hide').find(':input').prop('disabled', false);
            }
        });

        /**
         * Disable submit for polls on 'enter' press, blur instead (closes iOS keyboard)
         */
        $(document).on('keypress', '.pb-poll :input', function(e){
            var $input = $(this);
            if(e.which == 13){
                e.preventDefault();
                $input.blur();
            }
        });

        /**
         * Handle submit button
         */
        $(document).on('click', '#pb-submit', function(){
            $form.submit();
            Cookies.remove('budget-values');
            return false;
        });

        // Do surplus stuff
        var $surplusBox = $('.surplus');
        var $surplusSubmit = $('.js-submit-surplus');
        $surplusSubmit.on('click', function(e){

            if($tracker.data('available') > 0){

                showSuccess('Nice work! You\'re under budget!');

            }
            return false;

        });

        // setup tracker instance
        // use to track "tracker", total time, etc.
        var $tracker = $('.pb-tracker');
        $tracker.data('available', parseInt(settings.allowance));

        $tracker.affix({
            offset: {
                top: function () {
                    return (this.top = $('.pb-header').outerHeight(true)+$tracker.outerHeight(true))
                }
            }
        });

        $tracker.on('affixed.bs.affix', function(){
           $('body').css('margin-top', $tracker.outerHeight(true));
        });
        $tracker.on('affixed-top.bs.affix', function(){
            $('body').css('margin-top', 0);
        });

        // loop through each field
        var $orgs = $form.find('.pb-card');
        $orgs.each(function () {

            var $org = $(this);

            // flag for "dirty" or not (for poll popup, etc.)
            $org.data('dirty', false);
            $org.data('budget', 0);

            // update tracker to minimum or last saved value
            var minBudget    = $org.data('minBudget');
            var lastAllocated = getAllocatedFromCookie($org.data('id'));
            if(lastAllocated && lastAllocated >= minBudget){
                allocate($org, lastAllocated);
            }else{
                allocate($org, minBudget);
            }

            // Use input field just for display, actual value stored in data-budget attr
            $org.on('blur', '.org-budget-input', function (e) {
                e.preventDefault();
                var $input = $(this);
                var current = parseInt($org.data('budget'));
                var delta = parseInt($input.val()) - current;
                handleDelta($org, delta);
            }).on('keyup', '.org-budget-input', function (e) {
                var key = e.which;
                if (key == 13) { // the enter key code
                    e.preventDefault();
                    var $input = $(this);
                    $input.blur(); // blur triggers deltaUpdate
                    return false;
                }
            });

            $org.on('click', '.org-budget-ctrl .pb-btn-circle', function (e) {
                e.preventDefault();
                var $btn = $(this);
                var delta = $btn.data('delta');
                handleDelta($org, delta);
            });

            $org.on('click', '.org-btn-poll', function (e) {
                e.preventDefault();
                var $btn = $(this);
                viewPoll($org);
            });

            $org.on('click', '.org-btn-details', function (e) {
                e.preventDefault();
                var $btn = $(this);
                viewDetails($org);
            });

        });

        // Define common functions

        function handleDelta($org, delta) {
            hideMessages();

            settings.beforeChangeBudget.apply(null, [$org, delta]);

            // If first change
            if ($org.data('dirty') == false) {
                $org.data('dirty', true);
                //viewPoll($org);
            }
            // If we took some away
            if (delta < 0) {
                withdraw($org, Math.abs(delta));
            } else {
                allocate($org, delta);
            }

            saveProgressCookie();
        }

        function validateAllocate($org, amount) {
            //var unspent = parseInt($tracker.data('available'));
            // Must allocate more than '0' and stay above minimum req
            //return (amount > 0 && amount <= unspent);

            return amount > 0; // not worried about over budget cuz cant submit til back under budget
        }

        function allocate($org, amount) {
            amount = parseInt(amount);
            if (validateAllocate($org, amount)) {
                updateInput($org, amount);
                updateTracker(amount * -1);
            } else {
                // reset input
                updateInput($org, 0);
                if(amount != 0) {
                    sendMessage('danger', 'Can\'t allocate ' + amount);
                }
            }
        }

        function validateWithdraw($org, amount) {
            var current = parseInt($org.data('budget'));
            var mininum = parseInt($org.data('minBudget'));

            // Must withdraw more than '0' and stay above minimum req
            return (amount > 0 && (current - amount) >= mininum);
        }

        function withdraw($org, amount) {
            amount = parseInt(amount);
            if (validateWithdraw($org, amount)) {
                updateInput($org, amount * -1);
                updateTracker(amount);
            } else {
                // tried to remove more than we can so set input to minimum
                var current = parseInt($org.data('budget'));
                var minimum = parseInt($org.data('minBudget'));
                var leftToMin = current - minimum;
                // reset input
                updateInput($org, leftToMin * -1);
                if(leftToMin != 0) {
                    updateTracker(leftToMin);
                }
                var msg = 'The minimum budget for ' + $org.find('.org-name').text() + ' is ' + unitQtyStr(minimum) + '.';
                if (leftToMin) msg = msg + ' We could only withdraw ' + unitQtyStr(leftToMin) + '.';
                sendMessage('warning', msg);
            }
        }

        function updateTracker(delta) {
            var newBalance = $tracker.data('available') + delta;
            $tracker.data('available', newBalance);
            var perc = Math.max(0, Math.min(1, (settings.allowance - newBalance)/settings.allowance));
            var percPretty = Math.round(perc*100);
            updateProgressCircles(perc);
            if (newBalance == 0) {
                // Show "submit" button
                //sendMessage('success', 'Nice work! Your budget is balanced. <button id="pb-submit" type="button" class="btn btn-success">Submit</button>', true, successTpl);
                $surplusBox.hide();
                showSuccess('Nice work! Your budget is balanced.');
            } else if (newBalance < 0) {
                // Show "over budget" warning
                $surplusBox.hide();
                sendMessage('danger', 'Uh-oh! You\'re ' + unitQtyStr(newBalance) + ' over budget!');
            }else{
                $surplusBox.show();
            }

            // $unspent = $('.pb-unspent', $tracker).html(percPretty + '%');
            $unspent = $('.pb-unspent', $tracker).html(newBalance);
            animate($unspent, 'splash');
        }

        function updateProgressCircles(perc){
            $('.lg-circle,.sm-circle').each(function(){
                var $svg = $(this);
                var $circle = $svg.find('.animated-circle');
                var offset = $svg.data('dashOffset');
                $circle.css({
                    "stroke-dashoffset" : (offset - (offset * perc))
                });
            });
            // 126 works for radius of 20. Ex: 20 * 2PI = 125.67
            // For difference circle radii use R * 2PI to find the offset number
            // Also update in style sheet!
        }

        function saveProgressCookie(){

            var budgetState = {};

            $orgs.each(function (i) {
                var $org   = $(this);
                budgetState[$org.data('id')] = $org.data('budget');
            });
            // Save progress to to cookie for 7 days
            Cookies.set('budget-state', budgetState, { expires: 7 });

        }

        function getAllocatedFromCookie(orgId){
            var budgetState = Cookies.getJSON('budget-state');
            if(budgetState !== undefined){
                var value = (budgetState && budgetState[orgId] === undefined)
                    ? null
                    : budgetState[orgId];
                console.log(orgId);
                console.log(value);
            }
            console.log('No budget state for ' + orgId);
            return value;
        }

        function updateInput($org, delta) {
            var current = parseInt($org.data('budget'));
            var newBudget = current + delta;
            var $input = $org.find('.org-budget-input');
            $org.data('budget', newBudget);
            $input.val(newBudget);
            if(delta > 0){
                var $ctrl = $org.find('.org-budget-ctrl').addClass('in');
                $input.data('blinkTimeout', setTimeout(function(){$ctrl.removeClass('in');}, 50));
            }
            //animate($input, 'splash');
        }

        function animate($item, animClass) {
            $item.removeClass('animated ' + animClass);
            $item[0].offsetWidth = $item[0].offsetWidth;
            $item.addClass('animated ' + animClass);
        }

        function viewPoll($org) {

            var budgetId = $form.data('id');
            var orgId = $org.data('id');
            var dictionary = 'pollDictionary' + budgetId;
            var poll = window[dictionary][orgId];

            if (typeof poll === 'undefined') return;

            var dialogKey = '.dialog-poll-' + orgId;
            // Check if already exists. If so return cuz its already showing
            if(!registerDialog(dialogKey)) return;

            settings.beforeViewPoll.apply(null, [$org, poll]);

            var pollOptionMarkup = '';
            var answerOptions = ['a', 'b', 'c', 'd', 'e'];
            $.each(answerOptions, function (index, value) {
                if (poll['option_' + value] != '') {
                    pollOptionMarkup = pollOptionMarkup + '<label class="radio" for="answer_'+orgId+'_'+index+'"><input id="answer_'+orgId+'_'+index+'" type="radio" name="answer" value="' + poll['option_' + value] + '"> ' + poll['option_' + value] + '</label>';
                }
            });

            var pollOtherMarkup = '';

            if(!poll.hasOwnProperty('disable_other') || poll['disable_other'] == false) {
                pollOtherMarkup = '<span class="additional-info-wrap">' +
                    '<label class="radio" for="answer_' + orgId + '_other">' +
                    '<input id="answer_' + orgId + '_other" type="radio" name="answer" value="_other"> Other' +
                    '</label>' +
                    '<div class="additional-info hide"><input type="text" class="form-control" name="answer_other" placeholder="Describe" class="form-control" disabled=""></div>' +
                    '</span>';
            }
            var formHtml = '<form class="form pb-poll"><div class="form-group pb-poll-radios">' + pollOptionMarkup + pollOtherMarkup + '</div></form>';

            BootstrapDialog.show({
                title: poll.question,
                message: formHtml,
                type: BootstrapDialog.TYPE_DEFAULT,
                nl2br: false,
                buttons: [{
                    label: 'Submit',
                    cssClass: 'btn-primary',
                    action: function(dialog){

                        var $poll = dialog.getModalBody();

                        var pollData = {
                            answer: $('input[name="answer"]:checked', $poll).val(),
                            other:  $('input[name="answer_other"]', $poll).val()
                        }
                        var action = 'answer';
                        var answer = pollData.answer;

                        if(pollData.answer == '_other' && pollData.other !=''){
                            action = 'other';
                            answer = pollData.other;
                        }
                        $org.find('.pb-poll-input').remove();
                        $org.append($('<input class="pb-poll-input" name="org[' + orgId + '][poll_action]" type="hidden">').val(action));
                        $org.append($('<input class="pb-poll-input" name="org[' + orgId + '][poll_answer]" type="hidden">').val(answer));

                        dialog.close();

                    }
                }, {
                    label: 'Skip',
                    cssClass: 'btn-default',
                    action: function(dialog){
                        var action = 'skip';
                        $org.find('.pb-poll-input').remove();
                        $org.append($('<input class="pb-poll-input" name="org[' + orgId + '][poll_action]" type="hidden">').val(action));
                        dialog.close();
                    }
                }],
                onhidden: function(){
                    unregisterDialog(dialogKey);
                }
            });

        }

        function viewDetails($org) {

            var orgId = $org.data('id');
            if (typeof orgId === 'undefined' || !orgId) return;

            var dialogKey = '.dialog-org-' + orgId;
            // Check if already exists
            if(!registerDialog(dialogKey)) return;

            settings.beforeViewDetails.apply(null, [$org]);

            $.get('/ajax/organizations/' + orgId + '/details', function (data) {
                BootstrapDialog.show({
                    title: data.org.name,
                    message: data.content,
                    type: BootstrapDialog.TYPE_DEFAULT,
                    nl2br: false,
                    buttons: [{
                        label: 'Close',
                        cssClass: 'btn-default',
                        action: function(dialog){
                            dialog.close();
                        }
                    }],
                    onhidden: function(){
                        unregisterDialog(dialogKey);
                    }
                });
            }).fail(function(){
                showLoginDialog();
                unregisterDialog(dialogKey);
            });

        }

        function showSuccess(successMsg) {

            $('.pb-btn-resubmit').addClass('hidden');
            BootstrapDialog.show({
                title: '... And You\'re Done!',
                message: successMsg,
                type: BootstrapDialog.TYPE_DEFAULT,
                nl2br: false,
                buttons: [{
                    label: 'Make Changes',
                    cssClass: 'btn-default',
                    action: function(dialog){
                        dialog.close();
                        sendMessage('info', 'Please make changes and resubmit.', true);
                    }
                },{
                    label: 'Submit Budget',
                    cssClass: 'btn-success',
                    action: function(dialog){
                        settings.beforeFinishGame.call();
                        $form.submit();
                    }
                }]
            });

        }

        function unitQtyStr(qty) {
            var number = Math.abs(qty);
            return number != 1
                ? number + ' ' + settings.type_plural
                : number + ' ' + settings.type;
        }

        function sendMessage(type, msg, persist, template) {

            // initialize
            if(typeof persist == 'undefined')
                persist = false;
            if(typeof template == 'undefined')
                template = msgTpl;

            // only deal with timeouts for messages that disappear
            if(!persist){
                clearTimeout(msgInterval);
            }

            // show the message
            var $domMsg = $(msgTpl.replace(':type:', type).replace(':message:', msg));
            $msgBox.html('');
            $domMsg.appendTo($msgBox);

            // only deal with timeouts for messages that disappear
            if(!persist) {
                var msgInterval = setTimeout(function () {
                    $domMsg.fadeOut();
                }, 5000);
            }

        }

        function hideMessages(type) {
            var typeClass = (typeof type == 'undefined') ? '.alert' : '.alert-' + type;
            $msgBox.find(typeClass).remove();
        }

        function registerDialog(key){
            if($.inArray(key, activeDialogs) !== -1){
                return false;
            }else{
                activeDialogs.push(key);
                return true;
            }
        }

        function unregisterDialog(key){
            activeDialogs.splice( $.inArray(key, activeDialogs), 1 );
        }

        return $form;

    };

}(jQuery));