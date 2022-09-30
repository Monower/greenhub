@include('templates.user_header')
@include('templates.user_navbar')

<div class="container">
    <div class="d-flex justify-content-center pt-2">
        <div class="row">
            <div class="col">
                <h2>My following list</h2>

                @php
                    $following_list = \App\Models\Following::with('user')->where('user_id', auth()->user()->id)->get();

        
                    if (isset($following_list)) {
                        foreach ($following_list as $key=>$value) {
                            echo '<li>'.$value->user->user_name.'</li><br>';

                        }
                    }
                @endphp
            </div>
        </div>

    </div>
    
</div>


@include('templates.user_footer')