<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>uRent</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #2C3E50;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-options {
            width: 45%;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .login-options a {
            display: block;
            width: 80%;
            background-color: #2980B9;
            color: white;
            padding: 15px 0;
            text-align: center;
            text-decoration: none;
            margin: 10px 0;
            border-radius: 5px;
            font-size: 18px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .login-options a:hover {
            background-color: #1A5276;
        }

        .login-options a img {
            vertical-align: middle;
            margin-right: 10px;
        }
    </style>
</head>
<body>
        <a id="navbar__logo"><img src="urentlogo.png" class="navbar__image"></a>
        <div class="login-options">
            <a href="lllogin.php"><img src="landlord-icon.png" alt="Landlord Icon">Landlord</a>
            <a href="tlogin.php"><img src="tenant-icon.png" alt="Tenant Icon">Tenants</a>
        </div>
    </div>
</body>
</html>
