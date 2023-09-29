<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        @include('head')
        <!-- Styles -->
        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">  
        @include('navbar')
        <div class="container mt-5">
            <div class="row mb-5">
                <div class="col">
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label for="author">Select Author</label>
                            <select class="form-control authors-list" id="author" name="author">
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="title">Title</label>
                            <input class="form-control" type="text" id="title" name="title">
                        </div>
                        <div class="form-group">
                            <label for="release_date">Release date</label>
                            <input class="form-control" type="date" id="release_date" name="release_date">
                        </div>
                        <div class="form-group">
                            <label for="description">description</label>
                            <input class="form-control" type="text" id="description" name="description">
                        </div>
                        <div class="form-group">
                            <label for="isbn">ISBN</label>
                            <input class="form-control" type="text" id="isbn" name="isbn">
                        </div>
                        <div class="form-group">
                            <label for="format">Format</label>
                            <input class="form-control" type="text" id="format" name="format">
                        </div>
                        <div class="form-group">
                            <label for="number_of_pages">No. of pages</label>
                            <input class="form-control" type="text" id="number_of_pages" name="number_of_pages">
                        </div>
                        <button class="btn btn-primary mt-3" id="buttonSubmit">Login</button>
                        <p class="text-danger mt-2"></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cusom scripts -->
        <script>
            token_key = localStorage.getItem('token_key');
            function loadAuthors(){
                $.ajax({
                        type:"GET",
                        datatype: "json",
                        Accept: "*/*",
                        url: "https://candidate-testing.api.royal-apps.io/api/v2/authors", 
                        headers: {
                            "Authorization": token_key
                        },
                        success: function(result){
                            $.each(result.items, function(key, value){
                                $('.authors-list').append(
                                    "<option value=" + value.id + ">" + value.first_name + " " + value.first_name + "</option>"
                                )   
                            });
                        },
                        error: function (error) {
                            $('p').html('Something went wrong');
                        }
                });
            }
            $(document).ready(function(){
                loadAuthors();
            });


            $('#buttonSubmit').click(function(){
                console.log('clicked');
                author = { id: $('#author').val() }
                title = $('#title').val();
                release_date = $('#release_date').val();
                description = $('#description').val();
                isbn = $('#isbn').val();
                format = $('#format').val();
                number_of_pages = $('#number_of_pages').val();

                data = {author:author, title:title, release_date:release_date, description:description, isbn:isbn, format:format, number_of_pages:number_of_pages}
                newData = JSON.stringify(data);
                $.ajax({
                        type:"POST",
                        data: newData,
                        datatype: "json",
                        Accept: "*/*",
                        url: "https://candidate-testing.api.royal-apps.io/api/v2/books", 
                        headers: {
                            "Authorization": token_key
                        },
                        success: function(result){
                            Swal.fire(
                                'Success',
                                'Book has been added.',
                                'success'
                            )
                        },
                        error: function (error) {
                            $('p').html('Sonmething went wrong');
                        }
                });
            });
        </script>
        <!-- Scripts cdn -->
        @include('footer')
    </body>
</html>
