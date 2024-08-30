<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Job Notification Email</title>
</head>
<body>
    @if(isset($mailData['employer']))
        <h1>Hello {{$mailData['employer']}}</h1>
        <p>Job Title: {{$mailData['job']}}</p>
        <p>Employee Details:</p>
        <p>Name: {{$mailData['user']}}</p>
        <p>Email: {{$mailData['email']}}</p>
        <p>Mobile No: {{$mailData['mobile']}}</p>

    @elseif(isset($mailData['usermail']))
        <p>{{$mailData['usermail']}}</p>
    @endif
</body>
</html>
