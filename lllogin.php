<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login and Register</title>
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

        .form-container {
            width: 400px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            padding: 20px; 
        }

        .form-header {
            background-color: #2980B9;
            color: white;
            padding: 15px;
            font-size: 24px;
            font-weight: bold;
            text-align: center;
        }

        .form-section {
            padding: 20px;
            box-sizing: border-box; 
        }

        .form-section h2 {
            margin-bottom: 20px;
            color: #2980B9;
        }

        .form-group {
            margin: 15px 0;
            position: relative;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            padding-left: 40px;
            border: 1px solid #1B2A52;
            border-radius: 4px;
            font-size: 16px;
            box-sizing: border-box; 
        }

        .form-group img {
            position: absolute;
            top: 50%;
            left: 10px;
            transform: translateY(-50%);
            width: 20px;
            height: 20px;
        }

        .button {
            width: 100%;
            padding: 10px;
            background-color:#2980B9; 
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 18px;
            cursor: pointer;
            margin-top: 20px;
            transition: background-color 0.3s ease;
            box-sizing: border-box; 
        }

        .button:hover {
            background-color: #0F1E3A;
        }

    </style>
</head>
<body>
    <div class="form-container">
        <div class="form-header">
            Welcome
        </div>
        <div class="form-section">
            <h2>Landlord Login</h2>
            <form action="llaut.php" method="post">
                <div class="form-group">
                    <img src="user-icon.png" alt="User Icon">
                    <input type="text" name="user" placeholder="Username" required autocomplete="off">
                </div>
                <div class="form-group">
                    <img src="lock-icon.png" alt="Lock Icon">
                    <input type="password" name="password" placeholder="Password" required autocomplete="off">
                </div>
                <button type="submit" class="button">Login</button>
            </form>
        </div>
    </div>
</body>
</html>
