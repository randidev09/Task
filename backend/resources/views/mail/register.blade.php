Hello {{$data['name']}} !<br>
Thanks for registering account in this project, please verify your email with click this link :
<br><br>
<a href="http://localhost/verify_email/{{$data['user_id']}}/{{$data['verification_code']}}">Click here !</a>