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

    $('table.movie-list .main-movie-info .title a').click(function(e){
        e.preventDefault();
        movieId = $(this).data('id');
        console.log(movieId);
        $.ajax({
            url: 'movies/view/' + movieId,
            dataType: 'html',
            success: function(doc) {
                $('#movie-list').append(doc);
                $('#movie-popup').modal();
            }
        });
    });

    $('#movie-popup').on('hidden.bs.modal', function (e) {
        console.log('disposing modal');
        $('#movie-popup').remove();
    })
});