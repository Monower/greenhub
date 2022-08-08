@include('templates.user_header')
@include('templates.user_navbar')


<div class="container pt-3">
    <div class="row">
        <div class="col">
            <h2>{{$repository->name}}</h2> 
        </div>
        <div class="col"><button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#add-file">Add File</button></div>
        
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


@include('templates.user_footer')