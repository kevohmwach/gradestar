@component('mail::message')

<h2>Dear {{$name}}</h2>

<h1>{{$subject}}</h1>

<h3>Your download link is ready!</h3>

<p>Thank you for choosing Gradestar as your revision partner. 
We guarantee best quality revision materials for  you.</p>

<p>Please click on the link below to access your file.</p>

@foreach ($urls as $url)

<p><a href="{{url($url['link'])}}" >{{$url['prodTitle']}}</a></p>

@endforeach
<p> </p>
<p> </p>

<p>Kind regards,
<br>GradeStar solutions.
<br>Your true revision partner.</p>

@endcomponent
