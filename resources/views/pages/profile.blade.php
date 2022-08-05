@include('templates.user_header')
@include('templates.user_navbar')


<div class="container pt-3">
    <div class="row">
        <div class="col-lg-6 border border-primary">
            <img class="rounded-circle" height="150px" src="{{asset('storage/image/default/default-image.jpg')}}" alt="default image">

            <p>@if (auth()->check())
                {{auth()->user()->user_name}}
            @endif</p>

            <p>about</p>
            <p>addres</p>


            <p>@if (auth()->check())
                {{auth()->user()->email}}
            @endif</p>


              <!-- Button trigger profile edit modal -->
            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#edit-profile">
                edit profile
            </button>

            <button class="btn btn-sm btn-success">Follow</button>


        </div>
        <div class="col-lg-6 border border-primary">
            <div class="row">
                <div class="col">
                    <h3>Repositories</h3>
                </div>
                <div class="col">
                    <button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#add-repository">+</button>
                </div>
            </div>

            @if (isset($repository_name))
              <ul>
                @foreach ($repository_name as $repository)
                  <li>
                    <a href="{{route('user.show-repository', ['name'=>$repository->name])}}">{{ $repository->name}}</a>
                  </li>
                @endforeach
              </ul>
            @endif
            
        </div>

    </div>
</div>






  
  <!-- Edit Profile Modal -->
  <div class="modal fade" id="edit-profile" tabindex="-1" aria-labelledby="edit-profileLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="edit-profileLabel">Edit Profile</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <form action="{{route('user.info-update')}}" method="post" enctype="multipart/form-data">
            @csrf

           {{--  <img id="user_profile" class="rounded-circle" height="150px" src="{{asset('storage/image/default/default-image.jpg')}}" alt="default image"><br> --}}
           <div class="image-area mt-4">
            <img height="500px" width="500px"  id="imageResult" src="{{asset('storage/image/default/default-image.jpg')}}" alt="" class="img-fluid rounded shadow-sm mx-auto d-block">
          </div>

            {{-- <input type="file" name="user_profile_image" onchange="user_profile.src.window.URL.createObjectURL(this.files[0])" value="{{asset('storage/image/default/default-image.jpg')}}"><br> --}}
            <input class="form-control" type="file" name="user_image" id="image" oninput="imageResult.src=window.URL.createObjectURL(this.files[0])">
            About: <input name="user_about" type="text" placeholder="describe yourself"><br>
            Address: <input name="user_address" type="text" placeholder="enter your address"><br><br>

            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-sm btn-primary">Save changes</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  {{-- add repository modal --}}
  <div class="modal fade" id="add-repository" tabindex="-1" aria-labelledby="add-repository" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="add-repository">Create New Repository</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <form action="{{route('user.add-repository')}}" method="post" enctype="multipart/form-data">
            @csrf

            @if ($errors->any())
              @foreach($errors->all() as $error)
                  <p class="text-danger">{{$error}}</p>
              @endforeach
            @endif
            Name of the repository: <input type="text" name="name_of_the_repository"><br>
            Description: <br>
            <textarea name="description" cols="40" rows="10"></textarea><br>

            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-sm btn-primary">Next</button>
          </form>
        </div>
      </div>
    </div>
  </div>

@include('templates.user_footer')
  
  
  

  
  