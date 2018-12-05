Dear user,

You have received a new enquiry regarding booking a table at {{App\Event::current()->name}}.

Name: {{$name}}
Email: {{$email}}
Phone: {{$phone}}
------------------
@if($message)
Message: {{$messageText}}
@endif