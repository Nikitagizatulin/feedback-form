(function ($, undefined) {
    $(function () {
        $('input[name="read"]').click(function (e) {
            $('#preloader').fadeIn('slow');
            var id = $(this).attr('data-id');
            var csrf = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                async:false,
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
    })
})(jQuery);