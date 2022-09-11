@include('templates.user_header')
@include('templates.user_navbar')


<div class="container pt-3">
    <div class="row">
        <div class="col-6">
            <h2>{{$repository->name}}</h2>
        </div>
        @php($user = \App\Models\RepositoryName::with('user')->find($repository->id))
        {{-- {{dd($user->user->email)}} --}}
        <div class="col-5"><button class="btn btn-sm btn-success" type="button" data-bs-toggle="modal" data-bs-target="#add-file">Add File</button></div>
        <div class="col">
          <button class="btn btn-sm btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#delete_repository">Delete</button>
        </div>
    </div>
</div>

<div class="container">
  <div class="row">
    <div class="col">
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">SI</th>
            <th scope="col">File Name</th>
            <th scope="col">Operation</th>
          </tr>
        </thead>
        <tbody>

          @php($si = 1)
          @foreach ($file_name as $file)
            <tr class="table-active">
                  <td>{{$si}}</td>
                  <td><a href="{{route('user.view-file', ['user_mail'=>$user->user->email, 'file_id'=>$file->id])}}">{{$file->name}}</a></td>
                  <td><button class="btn btn-sm btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#delete_file{{$file->id}}">Delete</button></td>

                  @php($si +=1)

            </tr>


            <div class="modal fade" id="delete_file{{$file->id}}" tabindex="-1" aria-labelledby="delete_file" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="delete_file">You really want to delete this file?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">

                    <form action="{{route('user.delete-file')}}" method="post" enctype="multipart/form-data">
                      @csrf
                        <input type="hidden" name="repository_id" value="{{$repository->id}}">
                        <input type="hidden" name="file_id" value="{{$file->id}}">
                        <fieldset class="form-group">
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="delete_file" id="optionsRadios1" value="yes" checked="">
                            <label class="form-check-label" for="optionsRadios1">
                              Yes
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="delete_file" id="optionsRadios2" value="no">
                            <label class="form-check-label" for="optionsRadios2">
                              No
                            </label>
                          </div>
                        </fieldset>
                      <button type="submit" class="btn btn-sm btn-danger">Confirm</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>


<div class="modal fade" id="add-file" tabindex="-1" aria-labelledby="add-file" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="add-file">Add file to this repository</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <form action="{{route('user.add-file')}}" method="post" enctype="multipart/form-data">
            @csrf

            @if ($errors->any())
              @foreach($errors->all() as $error)
                  <p class="text-danger">{{$error}}</p>
              @endforeach
            @endif

              <input type="hidden" name="repository_id" value="{{$repository->id}}">
              <input type="file" name="file">

            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-sm btn-primary">Add</button>
          </form>
        </div>
      </div>
    </div>
  </div>



  <div class="modal fade" id="delete_repository" tabindex="-1" aria-labelledby="delete_repository" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="delete_repository">You really want to delete this repository?</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <form action="{{route('user.delete-repository')}}" method="post" enctype="multipart/form-data">
            @csrf
              <input type="hidden" name="repository_id" value="{{$repository->id}}">
              <fieldset class="form-group">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="repository_delete" id="optionsRadios1" value="yes" checked="">
                  <label class="form-check-label" for="optionsRadios1">
                    Yes
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="repository_delete" id="optionsRadios2" value="no">
                  <label class="form-check-label" for="optionsRadios2">
                    No
                  </label>
                </div>
              </fieldset>
            <button type="submit" class="btn btn-sm btn-danger">Confirm</button>
          </form>
        </div>
      </div>
    </div>
  </div>




@include('templates.user_footer')