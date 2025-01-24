<!DOCTYPE html>
<html>
<head>
    <title>{{$details['subject']}}</title>
</head>
<body>
    <h1>{{ $details['title'] }}</h1>
    <p>{{ $details['email'] }}</p>
    <p>{{ $details['body'] }}</p>
    <p>Silahkan akses website di alamat : {{route('login')}}</p>
</body>
</html>
