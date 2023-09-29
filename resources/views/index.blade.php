<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login</title>
        @include('head')
       <!-- Styles -->
        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">  
        <div class="container mt-5">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            Login
                        </div>
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label for="email">Email</label>
                                <input class="form-control" type="text" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input class="form-control" type="password" id="password" name="password" required>
                            </div>
                            <button class="btn btn-primary mt-3">Login</button>
                            <p class="text-danger mt-2"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>




        <!-- Cusom scripts -->
        <script>
            $("button").click(function(){
                console.log('button clicked');
                // email = "ahsoka.tano@royal-apps.io";
                // password = "Kryze4President";
                email = $('#email').val();
                password = $('#password').val();
               
                data = {email:email, password:password}
                newData = JSON.stringify(data);
                $.ajax({
                    data: newData,
                    type:"POST",
                    url: "https://candidate-testing.api.royal-apps.io/api/v2/token", 
                    success: function(result){
                        localStorage.setItem('token_key', result.token_key);
                        localStorage.setItem('user_id', result.user.id);
                        window.location.href = "{{url('profile')}}"; 
                    },
                    error: function (error) {
                        $('p').html('Invalid Credentials');
                    }
                });
            });
        </script>
        




       <!-- Scripts cdn -->
       @include('footer')
    </body>
</html>
