<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>List of Authors</title>
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
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            List of Authors
                        </div>
                        <div class="card-body">
                            <table class="table table-striped" id="authors-table">
                                <thead>
                                    <th colspan = '2'>Action</th>
                                    <th>Id</th>
                                    <th>First name</th>
                                    <th>Last name</th>
                                    <th>Gender</th>
                                    <th>Place of birth</th>
                                    <th>Birthday</th>
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




        <!-- Cusom scripts -->
        <script>
            token_key = localStorage.getItem('token_key');
            function loadData(){
                $.ajax({
                        type:"GET",
                        datatype: "json",
                        Accept: "*/*",
                        url: "https://candidate-testing.api.royal-apps.io/api/v2/authors", 
                        headers: {
                            "Authorization": token_key
                        },
                        success: function(result){
                            // console.log(result.items);
                            $.each(result.items, function(key, value){
                                $('#authors-table tbody').append(
                                    "<tr>" +
                                        "<td><a href={{ url('/authors') }}/" + value.id +  " type='button' class='btn btn-primary'>View</a></td>" +
                                        "<td><button onClick=buttonDelete(" + value.id  + ") type='button' class='btn btn-danger' id=" + value.id + ">Delete</button></td>" +
                                        "<td>" + value.id + "</td>" +
                                        "<td>" + value.first_name + "</td>" +
                                        "<td>" + value.last_name + "</td>" +
                                        "<td>" + value.gender + "</td>" +
                                        "<td>" + value.place_of_birth + "</td>" +
                                        "<td>" + new Date(value.birthday) + "</td>" +
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


            // Delete authors button code
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
                                    $('#authors-table tbody').html('');
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
