@extends('emails.template')
@section('mailSection')
    <tr>
        <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="left" style="font:16px/29px Arial, Helvetica, sans-serif; color:#888; padding:0 0 21px;">
            Greetings {{$recipient}},
        </td>        
    </tr>
    <tr>
        <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="left" style="font:16px/29px Arial, Helvetica, sans-serif; color:#888; padding:0 0 21px;">
            @if($enquiryType == 'general')
                Thank you for getting in touch with us, we'll get right back to you as soon as we can.
            @elseif($enquiryType == 'sponsor')
                Thank you for your interest in sponsoring Fight for Kidz, we will get in touch with you soon.
            @elseif($enquiryType == 'table')
                Thank you for your interest in booking a table at Fight for Kidz. We'll get right back to you as soon as we can.
            @endif
        </td>        
    </tr>
    <tr>
        <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="left" style="font:16px/29px Arial, Helvetica, sans-serif; color:#888; padding:0 0 21px;">
            <br> Regards, <br> <br> Fight for Kidz
        </td>        
    </tr> 
@endsection