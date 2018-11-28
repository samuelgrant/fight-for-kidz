@extends('emails.template')
@section('mailSection')
    <tr>
        <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="left" style="font:16px/29px Arial, Helvetica, sans-serif; color:#888; padding:0 0 21px;">
            Greetings {{$recipient}},
        </td>        
    </tr>
    <tr>
        <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="left" style="font:16px/29px Arial, Helvetica, sans-serif; color:#888; padding:0 0 21px;">
            {!!$messageText!!}
        </td>        
    </tr>
    <tr>
        <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="left" style="font:16px/29px Arial, Helvetica, sans-serif; color:#888; padding:0 0 21px;">
            <br> Regards, <br> <br> Fight for Kidz
        </td>        
    </tr> 
@endsection

@if($subscriber = App\Subscriber::where('email', $email)->get()->first())
    @section('unsubscribe')
    <a href="{{env('APP_URL') . '/unsubscribe?token=' . $subscriber->unsubscribe_token}}">Unsubscribe</a>
    @endsection
@endif