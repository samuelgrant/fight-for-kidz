@extends('emails.template')
@section('mailSection')
    <tr>
        <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="left" style="font:16px/29px Arial, Helvetica, sans-serif; color:#888; padding:0 0 21px;">
            Dear user,
        </td>        
    </tr>
    <tr>
        <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="left" style="font:16px/29px Arial, Helvetica, sans-serif; color:#888; padding:0 0 21px;">
            You have received a new sponsorship enquiry regarding {{App\Event::current()->name}}. Details follow:
        </td>        
    </tr>
    <tr>
        <table>
            <tr>
                <td>Name:</td>
                <td>{{$name}}</td>
            </tr>
            <tr>
                <td>Email:</td>
                <td>{{$email}}</td>
            </tr>
            <tr>
                <td>Phone:</td>
                <td>{{$phone}}</td>
            </tr>
            <tr>
                <td>Sponsorship Type:</td>
                <td>{{$type}}</td>
            </tr>
            <tr>
                <td>Message:</td>
                <td>{{$message}}</td>
            </tr>
        </table>  
    </tr> 
@endsection