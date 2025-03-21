<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Success</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
        }
        .container {
            text-align: center;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #333;
        }
        button {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
    <script>
        localStorage.setItem('token', '{{ $config["token"] }}');
    </script>
</head>
<body>

    <div class="container">
        <h2>Hey {{ $config['name'] }} You are Successfully Logged In</h2>
        <p>Please click Continue to Go next</p>
        <button onclick="redirectUser()">Continue</button>
    </div>

    <script>
        function redirectUser() {
            window.location.href = "{{ $config['redirectRoute'] }}"; // Change this to the correct route
        }
    </script>

</body>
</html>
