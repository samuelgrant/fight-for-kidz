Password Reset Link

Greetings {{$recipient}}. You are receiving this email because we received a password reset request for your account.

Copy the following into your browser to reset your password:
{{route('password.reset', ['token' => $token])}}

If you did not request a password reset, no further action is required.