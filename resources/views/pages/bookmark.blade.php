@include('templates.user_header')
@include('templates.user_navbar')

<div class="container">

<table class="table table-hover">
    <legend>
        <h2>Bookmarks <small><span class="badge bg-warning">{{\App\Models\RepositoryBookmark::with('repository')->where('user_id', auth()->user()->id)->count()}}</span></small></h2>
        
    </legend>
    <thead>
      <tr>
        <th scope="col">SI</th>
        <th scope="col">Name of the repository</th>
      </tr>
    </thead>
    <tbody>
      @php
          $bookmarks = \App\Models\RepositoryBookmark::with('repository')->where('user_id', auth()->user()->id)->get();
      @endphp
      @if (isset($bookmarks))
        @php
            $si =1;
        @endphp
          @foreach ($bookmarks as $key=>$value)
              <tr class="table-active">
                <td>{{$si}}</td>
                <td> <a style="text-decoration: none" href="{{route('user.show-repository', ['repository_id'=>$value->repository_id, 'user_id'=>$value->repository->user_id ])}}">{{ $value->repository->name}}</a></td>
                <td><a title="un-bookmark this repository" href="{{route('user.remove-bookmark', ['repository_id'=>$value->repository_id])}}" class="btn btn-sm"><i class="bi bi-bookmarks-fill"></i></a></td>
              </tr>
              @php
                  $si+=1;
              @endphp
          @endforeach
      @endif
    </tbody>
  </table>
  
  
</div>










@include('templates.user_footer')