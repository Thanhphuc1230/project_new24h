<!-- External JavaScripts -->
<script src="{{ asset('website/js/jquery-3.1.1.min.js ') }} "></script>
<script src="{{ asset('website/js/bootstrap.min.js ') }} "></script>
<script src="{{ asset('website/js/jquery-ui.min.js ') }} "></script>
<!-- JavaScripts -->
<script src="{{ asset('website/js/functions.js ') }} "></script>
<script>
    $(document).ready(function() {
        $('[data-toggle="collapse"]').click(function() {
            $('.sidenav').toggleClass('show');
        });
    });
</script>
{{-- live search --}}
<script>
    $(document).ready(function() {
        $('input[name="search"]').on('input', function() {
            var search = $(this).val();
            var url = "{{ url('/detail') }}";
            var $results = $('.search-results');

            $.ajax({
                url: '{{ route('website.liveSearch') }}',
                type: 'GET',
                data: {
                    'search': search
                },
                success: function(data) {
                    $results.empty();
                    if (data.length === 0) {
                        $results.append('<div class="search-result">Không tìm thấy bài viết</div>');
                    } else {
                        $.each(data, function(key, news) {
                            var imgSrc = (news.avatar.startsWith('https://')) ? news
                                .avatar : '{{ asset('images/news/') }}/' + news.avatar;
                            $('.search-results').append(
                                '<div class="search-result" style="padding-bottom: 5px;">' +
                                '<a  href="' + url + '/' + news.uuid +
                                '"><img  src="' + imgSrc +
                                '" height="50px" width ="60px"> </a>' +
                                '&nbsp&nbsp<a href="' + url + '/' + news.uuid +
                                '">' + news
                                .title + '</a>' +
                                '</div>'
                            );
                        });
                    }

                    $results.toggleClass('active', Boolean(search));
                }
            });
        });
    });
</script>
{{-- Load more --}}
<script>
    $(document).ready(function() {

        var _token = $('input[name="_token"]').val();
        var id_new = 0; // initialize id_new to 0

        load_data(id_new, _token);

        function load_data(id_new, _token) {
            $.ajax({
                url: "{{ route('website.load-data') }}",
                method: "POST",
                data: {
                    id_new: id_new,
                    _token: _token
                },
                success: function(data) {
                    $('#load_more_button').remove();
                    $('#post_data').append(data);
                }
            })
        }

        $(document).on('click', '#load_more_button', function() {
            id_new = $(this).data('id_new');
            $('#load_more_button').html('<b>Loading...</b>');
            load_data(id_new, _token);
        });

    });
</script>


</body>

</html>
