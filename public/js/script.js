(function ($, undefined) {
    $(function () {
        if ($('input[name="read"]').length > 0) {
            $('input[name="read"]').click(function (e) {
                $('#preloader').fadeIn('slow');
                var id = $(this).attr('data-id');
                var csrf = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    async  : false,
                    headers: {
                        'X-CSRF-TOKEN': csrf
                    },
                    method : 'POST',
                    url    : '/readed',
                    data   : {
                        id: id
                    },
                    success: $.proxy(function (data) {
                        $('#preloader').fadeOut('slow');
                    }, $(this)),
                    error  : function (data) {
                        $('#preloader').fadeOut('slow');
                        alert('Something went wrong. Please reload the page and trie again.')
                        return e.preventDefault();
                    }
                });
            });
        }
        ;
        if ($("#timer").length > 0) {
            $("#timer").TimeCircles({
                count_past_zero: false,
                time           : {
                    Days: {show: false}
                }
            }).addListener(function (unit, value, total) {
                if (total === 0) {
                    $("div.timerBlock").fadeOut();
                    $('input[type="submit"]').removeAttr('disabled');
                }
            });
        }

        if ($('.readMore').length > 0) {
            $(".readMore").click(function (e) {
                e.preventDefault();
                $('#preloader').fadeIn('slow');
                var id = $(this).attr('data-id');
                var csrf = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    async  : false,
                    headers: {
                        'X-CSRF-TOKEN': csrf
                    },
                    method : 'POST',
                    url    : '/readmore',
                    data   : {
                        id: id
                    },
                    success: $.proxy(function (data) {
                        var objData = $.parseJSON(data);
                        $('#myModal').find('h4.modal-title').text(objData.theme);
                        $('#myModal').find('div.modal-body').text(objData.message);
                        $('#preloader').fadeOut('slow');
                        $('#myModal').modal("show");
                    }, $(this)),
                    error  : function (data) {
                        console.log(data);
                    }
                });
            })
        }
    })
})(jQuery);