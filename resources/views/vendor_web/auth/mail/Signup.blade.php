Hello {{ $email_data['name'] }}
<br><br>
Welcome to Sathixa
<br>
Please click the below link to verify your email and activate your account!
<br><br>
<a href="{{ url('/webvendor/verify/'.$email_data['verification_code']) }}">Click Here!</a>

<br><br>
Thank you
<br>
Sathixa.com
