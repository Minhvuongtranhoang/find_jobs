<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Account Banned</title>
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card mt-5">
          <div class="card-header">
            <h3>Account Banned</h3>
          </div>
          <div class="card-body">
            <p>Your account has been banned for violating our terms of service. If you believe this is a mistake, please contact our support team.</p>
            <a href="{{ url('/') }}" class="btn btn-primary">Go to Homepage</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
