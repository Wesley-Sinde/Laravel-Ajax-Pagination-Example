<!DOCTYPE html>
<html>

<head>
    <title>Laravel 7 Ajax Pagination By wesley sinde</title>
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet"> 
     <script src="https://cdn.tailwindcss.com"></scrip
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha256-L/W5Wfqfa0sdBNIKN9cG6QA5F2qx4qICmU2VgLruv9Y=" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha256-WqU1JavFxSAMcLP2WIOI+GB2zWmShMI82mTpLDcqFUg=" crossorigin="anonymous"></script>
    <style type="text/css">
        .mt-5 {
            margin-top: 90px !important;
        }

    </style>
</head>

<body class="bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-2 mt-5">
                <div class="card">
                    <div class="card-header">
                        <h4>Laravel 7 Ajax Pagination Example - https://www.wesley.io.ke/</h4>
                    </div>
                    <div class="card-body">
                        <table style="border: black " class=" table table-bordered">
                            <thead>
                                <tr>
                                    <th width="100px">Id</th>
                                    <th>Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($blogs as $value)
                                    <tr>
                                        <td>{{ $value->id }}</td>
                                        <td>{{ $value->name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {!! $blogs->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(window).on('hashchange', function() {
            if (window.location.hash) {
                var page = window.location.hash.replace('#', '');
                if (page == Number.NaN || page <= 0) {
                    return false;
                } else {
                    getData(page);
                }
            }
        });

        $(document).ready(function() {
            $(document).on('click', '.pagination a', function(event) {
                event.preventDefault();

                $('li').removeClass('active');
                $(this).parent('li').addClass('active');

                var myurl = $(this).attr('href');
                var page = $(this).attr('href').split('page=')[1];

                getData(page);
            });

        });

        function getData(page) {
            $.ajax({
                url: '?page=' + page,
                type: "get",
                datatype: "html"
            }).done(function(data) {
                $("#tag_container").empty().html(data);
                location.hash = page;
            }).fail(function(jqXHR, ajaxOptions, thrownError) {
                alert('No response from server');
            });
        }
    </script>
    <footer class="px-3 text-lg text-center text-white no-underline uppercase bg-gray-900 py- italilc">
        <a href="https://www.wesley.io.ke/">Wesley Sinde: Some rights reserved {{ now()->year }}
        </a>
    </footer>
</body>

</html>
