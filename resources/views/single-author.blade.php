<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Single Author page</title>
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
                    <div class="card">
                        <div class="card-header">
                            Author Details
                        </div>
                        <div class="card-body author-details">
                            <!-- author details here from ajax -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            List of Books of <span class="author-name"></span>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped" id="books-table">
                                <thead>
                                    <th>Action</th>
                                    <th>Id</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>ISBN</th>
                                    <th>Format</th>
                                    <th>No. of pages</th>
                                    <th>Release date</th>
                                </thead>
                                <tbody>
                                    <!-- data here from ajax -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <input type="hidden" id="author-id" value="{{Request::segment(2)}}">


        
        <!-- Cusom scripts -->
        <script>
            token_key = localStorage.getItem('token_key');
            author_id = $('#author-id').val()
            console.log(author_id);
            function loadData(){
                $.ajax({
                        type:"GET",
                        datatype: "json",
                        Accept: "*/*",
                        url: "https://candidate-testing.api.royal-apps.io/api/v2/authors/" + author_id, 
                        headers: {
                            "Authorization": token_key
                        },
                        success: function(result){
                            $('.author-name').html(result.first_name + " " + result.last_name);
                            // console.log(result.items);

                            $('.author-details').html(
                                "<p><strong>Name:</strong> " + result.first_name + " " + result.last_name + "</p>" +
                                "<p><strong>Gender:</strong> " + result.gender + "</p>" +
                                "<p><strong>BioGraphy:</strong> " + result.biography + "</p>"
                            );


                            $.each(result.books, function(key, value){
                                $('#books-table tbody').append(
                                    "<tr>" +
                                        "<td><button onClick=buttonDelete(" + value.id  + ") type='button' class='btn btn-danger' id=" + value.id + ">Delete</button></td>" +
                                        "<td>" + value.id + "</td>" +
                                        "<td>" + value.title + "</td>" +
                                        "<td>" + value.description + "</td>" +
                                        "<td>" + value.isbn + "</td>" +
                                        "<td>" + value.format + "</td>" +
                                        "<td>" + value.number_of_pages + "</td>" +
                                        "<td>" + new Date(value.release_date) + "</td>" +
                                    "</tr>");
                            });
                        },
                        error: function (error) {
                            $('p').html('Invalid token');
                        }
                });
            }
            $(document).ready(function(){
                loadData();
            });



            // Delete book button code
            function buttonDelete(id){
                console.log('clicked');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                                type:"DELETE",
                                datatype: "json",
                                Accept: "*/*",
                                url: "https://candidate-testing.api.royal-apps.io/api/v2/books/" + id, 
                                headers: {
                                    "Authorization": token_key
                                },
                                success: function(result){
                                    // console.log(result);
                                    $('#books-table tbody').html('');
                                    loadData();
                                    Swal.fire(
                                        'Deleted!',
                                        'Record has been deleted.',
                                        'success'
                                        )
                                },
                                error: function (error) {
                                    $('p').html('Invalid token');
                                }
                        });
                    }
                })
            }

        </script>
        <!-- Scripts cdn -->
        @include('footer')
    </body>
</html>
