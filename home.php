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
            background: linear-gradient(135deg, #2A2F44, #5B4C69); /* Gradient background */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #FFFFFF; /* White*/
            overflow: hidden;
        }

        .container {
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(42, 47, 68, 0.8); 
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            animation: fadeIn 1.5s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        #navbar__logo {
            width: 900px; 
            margin-right: 30px; 
            transition: transform 0.3s ease;
        }

        #navbar__logo img {
            width: 100%;
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-15px);
            }
        }

        #navbar__logo:hover {
            transform: scale(1.1);
        }

        .login-options {
            width: 50%;
            max-width: 400px;
            text-align: center;
        }

        .login-options a {
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #5B4C69, #717D98); /* Gradient button  */
            color: #FFFFFF; /* Button text color */
            padding: 15px 20px;
            text-decoration: none;
            margin: 10px 0;
            border-radius: 5px;
            font-size: 20px;
            font-weight: bold;
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .login-options a::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 300%;
            height: 300%;
            background: rgba(255, 255, 255, 0.2); /* Slight white*/
            transform: translate(-50%, -50%) scale(0);
            transition: transform 0.5s ease;
            border-radius: 50%;
            z-index: 0;
        }

        .login-options a:hover::before {
            transform: translate(-50%, -50%) scale(1);
        }

        .login-options a img {
            vertical-align: middle;
            margin-right: 15px;
            width: 35px;
            z-index: 1;
        }

        .login-options a span {
            position: relative;
            z-index: 1;
        }

        .login-options a:hover {
            background: linear-gradient(135deg, #E68E8E, #5B4C69); /* Gradient */
            color: #2A2F44; /* Dark text color */
            transform: scale(1.05);
        }

        .login-options a:first-of-type {
            border-left: 4px solid #E68E8E; /* Light pink border */
        }

        .login-options a:nth-of-type(2) {
            border-left: 4px solid #717D98; /* blue border */
        }

        #greeting {
            position: absolute;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 28px;
            font-weight: bold;
            color: #E68E8E; /* Light pink */
        }
    </style>
</head>
<body>
    <div id="greeting">Welcome to URent!</div>
    <div class="container">
        <div id="navbar__logo">
            <img src="urentlogo.png" alt="uRent Logo">
        </div>
        <div class="login-options">
            <a href="lllogin.php"><img src="landlord-icon.png" alt="Landlord Icon"><span>Landlord</span></a>
            <a href="tlogin.php"><img src="tenant-icon.png" alt="Tenant Icon"><span>Tenants</span></a>
        </div>
    </div>

    <script>
        function updateGreeting() {
            const greetingElement = document.getElementById('greeting');
            const hours = new Date().getHours();
            let greetingMessage = 'Welcome to uRent!';

            if (hours < 12) {
                greetingMessage = 'Good Morning! Welcome to URent!';
            } else if (hours < 18) {
                greetingMessage = 'Good Afternoon! Welcome to URent!';
            } else {
                greetingMessage = 'Good Evening! Welcome to URent!';
            }

            greetingElement.textContent = greetingMessage;
        }

        updateGreeting();
    </script>
</body>
</html>
