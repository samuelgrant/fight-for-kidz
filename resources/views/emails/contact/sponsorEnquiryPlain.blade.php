Dear user,

You have received a new sponsorship enquiry regarding {{App\Event::current()->name}}. Details follow:

Name: {{$name}}
Company: {{$companyName}}
Email: {{$email}}
Phone: {{$phone}}
Sponsorship Type : {{$type}}
------------------
@if($message)
Message: {{$messageText}}
@endif