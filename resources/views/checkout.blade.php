<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{ route('credit') }}" method="POST">
        {{ csrf_field() }}
        <input style="width: fit-content" type="submit" value="Paymob" class="btn">
    </form>
</body>
</html>
