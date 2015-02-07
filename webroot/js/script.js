$(document).ready(function() {

$('#calendar').fullCalendar({
    events: function(start, end, timezone, callback) {
        $.ajax({
            url: '/movies/screenings/ajax',
            dataType: 'json',
            success: function(doc) {
                var events = [];
                $(doc).each(function(idx,event) {
                    console.log(event);
                    events.push({
                        title: event.title,
                        start: event.date,
                        url: event.url,

                    });
                });
                callback(events);
            }
        });
    }
});

});