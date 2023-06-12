$(function() {
  $('input[name="daterange"]').daterangepicker({
    opens: 'left'
  }, function(start, end, label) {
    console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));

    addOrUpdateURLParam('start_date', start.format('YYYY-MM-DD'));
    addOrUpdateURLParam('end_date', end.format('YYYY-MM-DD'));
    location.reload();
  });
});

var url= document.location.href;
window.onload = window.history.pushState({}, "", url.split("?")[0]);