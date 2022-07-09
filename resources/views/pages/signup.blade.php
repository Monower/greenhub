@include('templates.user_header')

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">GreenHub</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
  
      <div class="collapse navbar-collapse" id="navbarColor01">
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <a class="nav-link" href="#">Home
              <span class="visually-hidden">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/">Login</a>
          </li>
        </ul>
      </div>
    </div>
</nav>


<div class="container p-5">
    <div style="padding-left: 300px">
        <div class="col-5">
            

            <form action="signup" method="POST">
                 @csrf
                <fieldset>
                <legend>SignUp</legend>

                @if ($errors->any())
                    @foreach($errors->all() as $error)
                        {{-- <div class="warning">{{$error}}</div> --}}
                        <p class="text-danger">{{$error}}</p>
                    @endforeach
                @endif
                <div class="form-group">
                    <label for="exampleInputEmail1" class="form-label mt-4">User Name</label>
                    <input type="text" class="form-control" name="user_name" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Your Desired User name" value="{{old('user_name')}}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" class="form-label mt-4">Email address</label>
                    <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Your email" value="{{old('email')}}">
                </div>
                <div class="form-group pb-2">
                    <label for="exampleInputPassword1" class="form-label mt-4">Password</label>
                    <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password">
                </div>
                <div class="form-group pb-2">
                    <label for="exampleInputPassword1" class="form-label mt-4">Retype Password</label>
                    <input type="password" class="form-control" name="password_confirmation" id="exampleInputPassword1" placeholder="Re-enter Password">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                </fieldset>
            </form>
  
  
        </div>
    </div>
</div>








@include('templates.user_footer')