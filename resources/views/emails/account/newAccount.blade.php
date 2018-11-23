@extends('emails.template')
@section('mailSection')
    <tr>
        <td data-color="title" data-size="size title" data-min="20" data-max="40" data-link-color="link title color" data-link-style="text-decoration:none; color:#292c34;" class="title" align="center" style="font:30px/33px Arial, Helvetica, sans-serif; color:#292c34; padding:0 0 24px;">
            New Account Created
        </td>
    </tr>
    <tr>
        <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="left" style="font:16px/29px Arial, Helvetica, sans-serif; color:#888; padding:0 0 21px;">
            Greetings {{$recipient}}. You are receiving this email because Fight for Kidz have created an admin account for you. You need to set your password using the link below within 24 hours.
        </td>
    </tr>
    <tr>
        <td style="padding:0 0 20px;">
            <table width="134" align="center" style="margin:0 auto;" cellpadding="0" cellspacing="0">
                <tr>
                    <td data-bgcolor="bg-button" data-size="size button" data-min="10" data-max="16" class="btn" align="center" style="font:12px/14px Arial, Helvetica, sans-serif; color:#f8f9fb; text-transform:uppercase; mso-padding-alt:12px 10px 10px; border-radius:2px;" bgcolor="#f5ba1c">
                        <a target="_blank" style="text-decoration:none; color:#f8f9fb; display:block; padding:12px 10px 10px;" href="{{route('password.reset', ['token' => $token])}}">Reset Password</a>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="left" style="font:16px/29px Arial, Helvetica, sans-serif; color:#888; padding:0 0 21px;">
            If you were not expecting to have an account activated, please ignore this email.
        </td>
    </tr>    
@endsection