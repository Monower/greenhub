@include('templates.user_header')
@include('templates.user_navbar')


<div class="container pt-3">
    <div class="row">
        <div class="col-lg-6">
          {{-- {{dd($id)}} --}}
            @php($user_info = \App\Models\UserInfo::where('user_id', $id)->first())
            @php($user_profile_image = isset($user_info) ? $user_info->profile_picture_path : '')
            <img width="150px" height="150px" src="{{asset('storage/image/profile/'.$user_profile_image)}}" alt="default image" onerror="this.src='{{asset('storage/image/default/default-image.png')}}'">

            @php($user = \App\Models\User::find($id))
            <p>{{$user->user_name}}</p>

            <p>{{$user->email}}</p>

            @if (isset($user_info))
              <p>{{$user_info->about}}</p>
              <p>{{$user_info->address}}</p>
            @endif








              <!-- Button trigger profile edit modal -->

            @if (auth()->user()->id == $id)
              <i type="button" class="bi bi-gear-fill" data-bs-toggle="modal" data-bs-target="#edit-profile"></i>
            @endif

            @php($follow_info = \App\Models\Following::where('user_id', auth()->user()->id)->where('following_id',$id)->first())

            @if (auth()->user()->id != $id)
              @if (isset($follow_info))
                <a href="{{route('user.unfollow', ['id'=>$id])}}" class="btn btn-sm btn-dark">Unfollow</a> 
              @else
                <a href="{{route('user.follow', ['id'=>$id])}}" class="btn btn-sm btn-primary">Follow</a>
              @endif
            @endif


            

            @if (auth()->check())
                @if (!auth()->user()->id)
                  <button class="btn btn-sm btn-success">Follow</button>
                  <button class="btn btn-primary btn-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
                      <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555ZM0 4.697v7.104l5.803-3.558L0 4.697ZM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757Zm3.436-.586L16 11.801V4.697l-5.803 3.546Z"/>
                    </svg>
                  </button>
                @endif
            @endif
        </div>

        <div class="col-lg-6">
            <div class="row">
                <div class="col">
                    <h3>Repositories</h3>
                </div>
                @if (auth()->user()->id == $id)
                  <div class="col">
                    <i title="add repository" type="button" data-bs-toggle="modal" data-bs-target="#add-repository" class="bi bi-folder-plus"></i>
                  </div>
                @endif
            </div>

            @if (isset($repository))
              <ul>
                @foreach ($repository as $repository)
                  <li>
                    <a style="text-decoration: none" href="{{route('user.show-repository', ['repository_id'=>$repository->id, 'user_id'=>$id])}}">{{ $repository->name}}</a>
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
            <img height="200px" width="300px"  id="imageResult" src="{{asset('storage/image/profile/'.$user_profile_image)}}" alt="" class="img-fluid rounded shadow-sm mx-auto d-block" onerror="this.src='{{asset('storage/image/default/default-image.png')}}'">
          </div>

            {{-- <input type="file" name="user_profile_image" onchange="user_profile.src.window.URL.createObjectURL(this.files[0])" value="{{asset('storage/image/default/default-image.jpg')}}"><br> --}}
            <small>*select an image to change the profile picture*</small>
            <input class="form-control" type="file" name="user_image" id="image" oninput="imageResult.src=window.URL.createObjectURL(this.files[0])" required>

            <label for="exampleInputEmail1" class="form-label mt-4">About</label>
            
            <input name="user_about" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{isset($user_info) ? $user_info->about : ''}}" placeholder="{{empty($user_info) ? 'describe your self' : ''}}">
            <label for="exampleInputEmail2" class="form-label">Address</label>
            <input name="user_address" type="text" class="form-control" id="exampleInputEmail2" aria-describedby="emailHelp" value="{{isset($user_info) ? $user_info->address : ''}}" placeholder="{{empty($user_info) ? 'provide your address' : ''}}"><br>

            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
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
  
  
  

  
  