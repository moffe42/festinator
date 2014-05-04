$(document).ready(function() {
    initialTransfer();
	$('textarea[name=headline]').on('keyup', transferHeading);
	$('textarea[name=invitation]').on('keyup', transferInvitation);
});

var initialTransfer = function () {
    if ($('#headline').val().length != 0) {
	    $('#posterheadline').text($('#headline').val());
    }
    if ($('#invitation').val().length != 0) {
        var str = $('#invitation').val().replace(/\n/g, '<br>');
	    $('#posterinvitation').html(str);
    }
} 

var transferHeading = function (event) {
	$('#posterheadline').html($(this).val());
}
var transferInvitation = function (event) {
    var str = $(this).val().replace(/\n/g, '<br>');
	$('#posterinvitation').html(str);
}
