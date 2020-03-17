Dear user,

You have received a new general enquiry from the Fight for Kidz website.

**SENDERS INFO**
Name: {{$name}}
Email: {{$email}}
Phone Number: {{$phone}}

------------------

Enquiry Type: {{$enquiryType}}

You can view the full message here: {{route('admin.messages')}}

------------------

@if($message)
Message: {{$messageContent}}
@endif