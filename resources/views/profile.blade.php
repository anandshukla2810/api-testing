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
    @include('navbar')
    <body class="antialiased">  
        <div class="container mt-5">
            <div class="row mb-5">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            User Details
                        </div>
                        <div class="card-body author-details">
                            <!-- author details here from ajax -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cusom scripts -->
        <script>
            token_key = localStorage.getItem('token_key');
            user_id = localStorage.getItem('user_id');
            console.log(user_id);
            function loadData(){
                $.ajax({
                        type:"GET",
                        datatype: "json",
                        Accept: "*/*",
                        url: "https://candidate-testing.api.royal-apps.io/api/v2/users/" + user_id, 
                        headers: {
                            "Authorization": token_key
                        },
                        success: function(result){
                            $('.author-details').html(
                                "<p><strong>First name:</strong> " + result.first_name + "</p>" +
                                "<p><strong>Last name:</strong> " + result.last_name + "</p>" +
                                "<p><strong>Email:</strong> " + result.email + "</p>" +
                                "<p><strong>Gender:</strong> " + result.gender + "</p>"
                            );
                        },
                        error: function (error) {
                            $('p').html('Invalid token');
                        }
                });
            }
            $(document).ready(function(){
                loadData();
            });
        </script>
        <!-- Scripts cdn -->
        @include('footer')
    </body>
</html>
