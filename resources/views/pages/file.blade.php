@include('templates.user_header')
@include('templates.user_navbar')





<div class="container">
    <div class="row p-3">
        <div class="col-8" style="background-color: bisque">
            @php
                $si=1;
                while(($line = fgets($contents)) != false){
                    echo $si.'.  '.$line.'<br>';
                    $si++;
                }    
            @endphp
        </div>
        <div class="col-4">
            <form action="{{route('user.add-comment')}}" method="post">
                @csrf

                <input type="hidden" name="file_id" value="{{$file->id}}">
                <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                <div class="form-group">

                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Add comments" name="comment" required>
                    <button type="submit" class="btn btn-sm btn-primary">Comment</button>
                  </div>
            </form>

            <h2 class="pt-2">Comments:</h2>
            @php
                $comments=\App\Models\FileComment::with('user')->where('file_id',$file->id)->get()
            @endphp


            @if (isset($comments))

            {{-- {{dd($comments)}} --}}
                 
                @foreach ($comments as $key=>$value)
                    <div class="p-2">
                        <li>
                            <b>{{ $value->user->user_name}}</b>  <br>
                            {{ $value->comment }}
                        </li>
                    </div>                  
                @endforeach
            @endif
        </div>
    </div>

</div>









@include('templates.user_footer')