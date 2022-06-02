$.ajaxSetup({
    cache: false //disable ajax call caching by the browser
})

$(document).ready(function() {
$.ajax({
    url: 'autocomplete.php',
    type: 'POST',
    dataType: 'json',
    success: function(data) {
        for (var i = 0; i < data.length; i++) {
            $('select').append('<option>'+data[i].months+'</option>');
            }
        }
    });
})