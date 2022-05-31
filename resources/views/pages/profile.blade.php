@include('templates.user_navbar')
{{'this is profile page.'}}

<h2>hi {{Session::get('user')}}</h2>