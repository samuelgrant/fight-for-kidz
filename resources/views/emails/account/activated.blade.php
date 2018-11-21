@extends('emails.template')
@section('mailSection')
    <tr>
        <td data-color="title" data-size="size title" data-min="20" data-max="40" data-link-color="link title color" data-link-style="text-decoration:none; color:#292c34;" class="title" align="center" style="font:30px/33px Arial, Helvetica, sans-serif; color:#292c34; padding:0 0 24px;">
            Account Activated
        </td>
    </tr>
    <tr>
        <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:16px/29px Arial, Helvetica, sans-serif; color:#888; padding:0 0 21px;">
            Greetings {{$recipient}}. An administrator has enabled your account. You can now login to manage the website below.
        </td>
    </tr>
    <tr>
        <td style="padding:0 0 20px;">
            <table width="134" align="center" style="margin:0 auto;" cellpadding="0" cellspacing="0">
                <tr>
                    <td data-bgcolor="bg-button" data-size="size button" data-min="10" data-max="16" class="btn" align="center" style="font:12px/14px Arial, Helvetica, sans-serif; color:#f8f9fb; text-transform:uppercase; mso-padding-alt:12px 10px 10px; border-radius:2px;" bgcolor="#f5ba1c">
                        <a target="_blank" style="text-decoration:none; color:#f8f9fb; display:block; padding:12px 10px 10px;" href="{{route('login')}}">Login</a>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
@endsection