<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{config('app.name')}}</title>
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"></script>


    <style>
/*                     body {
            background-color: #74EBD5;
            background-image: linear-gradient(90deg, #74EBD5 0%, #9FACE6 100%);

            min-height: 100vh;
            } */

            ::-webkit-scrollbar {
            width: 5px;
            }

            ::-webkit-scrollbar-track {
            width: 5px;
            background: #f5f5f5;
            }

            ::-webkit-scrollbar-thumb {
            width: 1em;
            background-color: #ddd;
            outline: 1px solid slategrey;
            border-radius: 1rem;
            }

            .text-small {
            font-size: 0.9rem;
            }

            .messages-box,
            .chat-box {
            height: 510px;
            overflow-y: scroll;
            }

            .rounded-lg {
            border-radius: 0.5rem;
            }

            input::placeholder {
            font-size: 0.9rem;
            color: #999;
            }
    </style>

</head>
<body>



     <nav class="navbar navbar-expand-lg navbar-dark bg-primary" style="padding: 15px">
            <div class="container-fluid">
                <form class="d-flex">
                    <input class="form-control me-sm-2" type="text" placeholder="Search">
                    <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>

            <a class="btn btn-sm btn-primary" href="{{route('user.get_user_message')}}">Messages</a>
            <a class="btn btn-sm btn-primary" href="{{route('user.user_bookmarks')}}">Bookmarks</a>
            <a class="btn btn-sm btn-primary" href="{{route('user.get_notices')}}">Notices</a>
            
            <ul class="navbar-nav me-auto">
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Options</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Profile</a>
                    <a class="dropdown-item" href="#">Following</a>
                    <a class="dropdown-item" href="#">Logout</a>
                </div>
                </li>
            </ul>
      </nav>

      
      