<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>激活 Weibo App 账号</title>
</head>
<body>
  <h1>感谢您再Weibo App 网站进行注册！</h1>
  <p>请点击下面的链接进行激活：
    <a href="{{ route('confirm_email', $user->activation_token) }}">{{ route('confirm_email', $user->activation_token) }}</a>
  </p>
  <p>如果不是您本人进行的操作，请忽略此邮件</p>
</body>
</html>
