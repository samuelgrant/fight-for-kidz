Greetings {{$subscriber->name}},

You have successfully subscribed to updates from Fight for Kidz.

If this is a mistake, please click the 'unsubscribe' link at the bottom of this email.

Regards,

Fight for Kidz

Unsubscribe URL:
{{env('APP_URL') . '/unsubscribe?token=' . $subscriber->unsubscribe_token}}