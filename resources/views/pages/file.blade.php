@include('templates.user_header')
@include('templates.user_navbar')





<div class="container">
    <div class="row p-3">
        <div class="col" >
            @php
                $si=1;
                while(($line = fgets($contents)) != false){
                    echo $si.'.'.$line.'<br>';
                    $si++;
                }    
            @endphp
        </div>
        <div class="col">
            Add Comment:
            <input type="text">
        </div>
    </div>

</div>









@include('templates.user_footer')