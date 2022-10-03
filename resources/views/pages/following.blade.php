@include('templates.user_header')
@include('templates.user_navbar')

<div class="container">
    <div class="d-flex justify-content-center pt-2">
        <div class="row">
            <div class="col">
                <h2>My following list</h2>
                @php
                    $following_list = \App\Models\Following::with('user')->where('user_id', auth()->user()->id)->get();
                @endphp
            </div>
        </div>

    </div>
    
</div>

<div class="container">
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">SI</th>
                <th scope="col">Name</th>
                <th scope="col">Operation</th>
            </tr>
            </thead>
            <tbody>
            @if (isset($following_list))
                    @php
                        $si=1;    
                    @endphp
                @foreach ($following_list as $key=>$value)
                    <tr>
                        <td>{{$si}}</td>
                        <td><a href="{{route('user.dashboard', ['id'=>$value->following_id])}}">{{$value->user->user_name}}</a></td>
                        <td><a href="{{route('user.unfollow', ['id'=>$value->following_id])}}" class="btn btn-sm btn-dark">Unfollow</a></td>
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