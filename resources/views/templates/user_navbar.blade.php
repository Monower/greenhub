

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
                    <a class="dropdown-item" href="{{route('user.dashboard')}}">Profile</a>
                    <a class="dropdown-item" href="#">Following</a>
                    <a class="dropdown-item" href="{{route('user.logout')}}">Logout</a>
                </div>
                </li>
            </ul>
      </nav>

      
      