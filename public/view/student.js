$(function() {
    $('input[name="daterange"]').daterangepicker({
        opens: 'left'
    }, function(start, end, label) {
        console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));

        addOrUpdateURLParam('start_date', start.format('DD-MM-YYYY'));
        addOrUpdateURLParam('end_date', end.format('DD-MM-YYYY'));
        location.reload();
    });
});

var url= document.location.href;
window.onload = window.history.pushState({}, "", url.split("?")[0]);