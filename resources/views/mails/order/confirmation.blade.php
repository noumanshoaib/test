<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    The user has placed the order 
    here are the details
     Customer Name: {{$order->user->name}}
     <br>
      Product Name: {{$order->product->name}}
      <br>
      Product Price: {{$order->product->price}}
      <br>
      Order Created at: {{$order->created_at}}
      <br>
</body>
</html>