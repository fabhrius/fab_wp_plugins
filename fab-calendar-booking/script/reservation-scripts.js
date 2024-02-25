jQuery(document).ready(function ($) {

    // Timepicker
    $('#reservation-time').timepicker({
        timeFormat: 'HH:mm',
        interval: 15, // 15-minute intervals
        scrollbar: true
    });

    // Datepicker
    $('#reservation-date').datepicker({
        minDate: 0, // Disable past dates
        dateFormat: 'yy-mm-dd'
    });


});

