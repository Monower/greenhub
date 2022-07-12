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
                    <button class="btn btn-success">+</button>
                </div>
            </div>
            
        </div>

    </div>
</div>






  
  <!-- Modal -->
  <div class="modal fade" id="edit-profile" tabindex="-1" aria-labelledby="edit-profileLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="edit-profileLabel">Edit Profile</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <form action="{{route('user.info-update')}}" method="post">
            @csrf

           {{--  <img id="user_profile" class="rounded-circle" height="150px" src="{{asset('storage/image/default/default-image.jpg')}}" alt="default image"><br> --}}
           <div class="image-area mt-4">
            <img height="500px" width="500px"  id="imageResult" src="#" alt="" class="img-fluid rounded shadow-sm mx-auto d-block">
          </div>

            {{-- <input type="file" name="user_profile_image" onchange="user_profile.src.window.URL.createObjectURL(this.files[0])" value="{{asset('storage/image/default/default-image.jpg')}}"><br> --}}
            <input class="form-control" type="file" name="file" id="image" oninput="imageResult.src=window.URL.createObjectURL(this.files[0])">
            About: <input name="user_about" type="text" placeholder="describe yourself"><br>
            Address: <input name="user_address" type="text" placeholder="enter your address"><br><br>

            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-sm btn-primary">Save changes</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  
  
  

  
  