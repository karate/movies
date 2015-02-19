$(document).ready(function() {
/*
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
    });*/

    $('.datetimepicker').datetimepicker({
      format:'d-m-Y H:i',
      //lazyInit: true,
      defaultTime: '20:00',
      dayOfWeekStart: 1,
  });

    $('table.movie-list .title a').click(function(e){
        e.preventDefault();
        movieId = $(this).data('id');
        console.log(movieId);
        $.ajax({
            url: baseUrl + 'movies/view/' + movieId,
            dataType: 'html',
            success: function(doc) {
                $('#movie-list').append(doc);
                $('#movie-popup').modal();
            }
        });
    });

    $('#movie-popup').on('hidden.bs.modal', function (e) {
        $('#movie-popup').remove();
    })

    $(".datetime-form").hide();

    $('.add-movie-to-calendar').click(function(e) {
        e.preventDefault();
        $('form.datetime-form').fadeOut(200);
        $(this).parent().find('form.datetime-form').fadeIn(200);
    });

    $('a.hide-datetime').click(function(e){
        e.preventDefault();
        $(this).parent().fadeOut(200);
    });
});