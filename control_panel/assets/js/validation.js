$(document).ready(function() {
    var numeric = new RegExp('[+-]?[0-9]');

    $('[data-validate="numeric"]').keyup(function() {
        if(!numeric.test($(this).val())) {
            //TODO: Delete previously entered character
        }
    });
});