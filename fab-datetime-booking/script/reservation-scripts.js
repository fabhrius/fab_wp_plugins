jQuery(document).ready(function($) {
    // Initialize datetimepicker
    $('#booking-date').datetimepicker({
        onSelectDate: function(selectedDate, dateStr, instance) {
            var dateString = selectedDate.getFullYear() + '-' + (selectedDate.getMonth() + 1) + '-' + selectedDate.getDate();

            console.error('dateString = ', dateString);
            console.error('selectedDate=', selectedDate);
            console.error('selectedDate in millis=', selectedDate.getTime());
            console.error('selectedDate date=', selectedDate.getDate());
            console.error('selectedDate month=', selectedDate.getMonth());
            console.error('selectedDate year=', selectedDate.getFullYear());

            $.ajax({
                url: reservation_ajax_object.ajaxurl, // WordPress AJAX URL
                type: 'POST',
                data: {
                    action: 'get_available_times',
                    selectedDate: dateString
                },
                success: function(response) {
                    console.log('Response:', response); // Log the entire response object
                    console.log('Available Times:', response.data.availableTimes); // Log the available times array
                    // Update timepicker options with available times
                    // $('#booking-date').datetimepicker('option', 'allowTimes', response.data.availableTimes);
                    $('#booking-date').datetimepicker({allowTimes:response.data.availableTimes});
                },                
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }
    });
});





