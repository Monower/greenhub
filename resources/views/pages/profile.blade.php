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

            <button class="btn btn-sm btn-success">edit profile</button>

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