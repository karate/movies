$(document).ready(function() {

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