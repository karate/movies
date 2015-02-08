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
        },
        firstDay: 1,
    });

    $('table.movie-list #remove-movie-from-calendar').click(function(e){
        e.preventDefault()
        screeningId = $(this).data('id');

        $.ajax({
            url: '/movies/screenings/delete',
            dataType: 'json',
            data: {"id": screeningId},
            success: function(doc) {
                if (doc.status == 'ok') {
                    //
                }
            }
        });
    });

    $('.datetimepicker').datetimepicker({
      format:'d-m-Y H:i',
      //lazyInit: true,
      defaultTime: '20:00',
      dayOfWeekStart: 1,
    });
});