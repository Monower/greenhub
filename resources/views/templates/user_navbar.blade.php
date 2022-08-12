

     <nav class="navbar navbar-expand-lg navbar-dark bg-primary" style="padding: 15px">
            <div class="container-fluid">
                <form class="d-flex">
                    <input id="search" class="form-control me-sm-2" type="text" placeholder="Search" name="search">
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
      <div class="container">

        
      </div>
      <div class="row" style="padding-left: 30px">
        <div class="col col-3">
            <div style="background-color: aquamarine" id="result"></div>
        </div>
    </div>
      

      
      