<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Đặt Lại Mật Khẩu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
        }
        .footer {
            margin-top: 30px;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Đặt Lại Mật Khẩu</h2>

        <p>Bạn nhận được email này vì chúng tôi đã nhận được yêu cầu đặt lại mật khẩu cho tài khoản của bạn.</p>

        <p>Vui lòng click vào nút bên dưới để đặt lại mật khẩu:</p>

        <a href="{{ route('password.reset', ['token' => $token]) }}" class="button">
            Đặt Lại Mật Khẩu
        </a>

        <p>Nếu bạn không yêu cầu đặt lại mật khẩu, bạn có thể bỏ qua email này.</p>

        <p>Link đặt lại mật khẩu sẽ hết hạn sau 24 giờ.</p>

        <div class="footer">
            <p>Nếu bạn gặp vấn đề khi click vào nút "Đặt Lại Mật Khẩu", vui lòng copy và paste đường link sau vào trình duyệt của bạn:</p>
            <p>{{ route('password.reset', ['token' => $token]) }}</p>
        </div>
    </div>
</body>
</html>
