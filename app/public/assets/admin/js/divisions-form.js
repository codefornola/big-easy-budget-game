$(document).ready(function(){

    var $collection = $('#division-collection');
    var $name = $('#division-name').attr('name', '');
    var $tooltip = $('#division-tooltip').attr('name', '');
    var $addBtn = $('#division-btn-add');
    var templateHtml = $('#division-item-template').html();
    var $submitBtn = $('#submitBtn');

    var count = $('.box-collection-row', $collection).size();

    $submitBtn.on('click', function(e){
        e.preventDefault();
        var $divisionName = $('#division-name');
        var $divisionTooltip = $('#division-tooltip');

        if($divisionName.val() != '' || $divisionTooltip.val() != ''){
           BootstrapDialog.confirm({
               title: 'Heads up',
               message: 'You have an unsaved division "' + $name.val() + '".<br>Do you want continue without saving?',
               type: BootstrapDialog.TYPE_DANGER,
               btnOKLabel: 'Ignore Unsaved Division',
               //btnOKClass: 'btn-default',
               btnCancelLabel: 'Save Division and Submit',
               callback: function(withoutSaving) {
                   if (!withoutSaving) {
                       $addBtn.trigger('click');
                   }
                   $submitBtn.closest('form').submit();
               }
           });
        }else{
            $submitBtn.closest('form').submit();
        }

    });

    $addBtn.on('click', function(){

        var name = $name.val();
        if(name!=''){
            var tooltip = $tooltip.val();
            // Create item from template HTML
            var $newItem = $(templateHtml);
            // Fix inputs in template with proper name index etc.
            var $newName = $('.input-name', $newItem);
            $newName.attr('name', $newName.data('name').replace(':num:', count)).val(name);
            var $newTooltip = $('.input-tooltip', $newItem);
            $newTooltip.attr('name', $newTooltip.data('name').replace(':num:', count)).val(tooltip);
            // Save index
            $newItem.data('index', count);
            // Increase index
            count++;
            // Also populate display text divs
            $('.display-name', $newItem).text(name);
            $('.display-tooltip', $newItem).html(tooltip);
            // Add to DOM
            $collection.append($newItem);
            // Reset form values
            $tooltip.data('medium').destroy();
            $tooltip.val('');
            $tooltip.data('medium').setup();
            $name.val('');
        }
        $name.focus();

    });

    $collection.on('click', '.division-btn-remove', function(){

        var $btn = $(this);
        $btn.closest('.division-row').remove();

    });


    $collection.on('click', '.division-btn-edit', function(){

        var prevCount = count;

        var $btn = $(this);
        var $row = $btn.closest('.division-row');

        var oldIndex = $row.data('index');
        var oldName = $('.input-name', $row).val();
        var oldTooltip = $('.input-tooltip', $row).val();

        $row.remove();

        $name.val(oldName);
        $tooltip.data('medium').destroy();
        $tooltip.val(oldTooltip);//.data('medium').setContent(oldTooltip);
        $tooltip.data('medium').setup();


        count = prevCount;

    });

});