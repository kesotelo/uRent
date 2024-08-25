<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tenant Login and Register</title>
    <style>
              body {
                    margin: 0;
                    padding: 0;
                    font-family: Arial, sans-serif;
                    background: linear-gradient(135deg, #2A2F44 0%, #5B4C69 50%, #E68E8E 100%); /* Gradient background */
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 100vh;
                    color: #FFFFFF;
                }

                .form-container {
                    width: 400px;
                    background: #2A2F44; /* Solid white background for the form */
                    border-radius: 10px;
                    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
                    overflow: hidden;
                    padding: 20px;
                    animation: fadeIn 1.5s ease-in-out;
                }

                @keyframes fadeIn {
                    from { opacity: 0; transform: translateY(20px); }
                    to { opacity: 1; transform: translateY(0); }
                }

                .form-header {
                    background: linear-gradient(135deg, #5B4C69 0%, #2A2F44 100%); /* Gradient header background */
                    color: #FFFFFF;
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
                    color: #FFFFFF; /* Dark blue-gray */
                }

                .form-group {
                    margin: 15px 0;
                    position: relative;
                }

                .form-group input {
                    width: 100%;
                    padding: 10px;
                    padding-left: 40px;
                    border: 1px solid #717D98; /* Muted blue border */
                    border-radius: 5px;
                    font-size: 16px;
                    box-sizing: border-box;
                    background: #FFFFFF; /* White background */
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
                    background: linear-gradient(135deg, #E68E8E 0%, #F1C6C6 100%); /* Gradient button background */
                    color: #FFFFFF;
                    border: none;
                    border-radius: 5px;
                    font-size: 18px;
                    cursor: pointer;
                    margin-top: 20px;
                    transition: background-color 0.3s ease, transform 0.3s ease;
                    box-sizing: border-box;
                }

                .button:hover {
                    background: linear-gradient(135deg, #E68E8E 0%, #F1C6C6 100%); /* Light pink on hover */
                    transform: scale(1.05);
                }
                    .back-to-home {
                position: absolute;
                bottom: 20px;
                right: 20px;
                background: #5B4C69; /* Button color */
                color: #FFFFFF; /* Text color */
                padding: 10px 20px;
                border: none;
                border-radius: 5px;
                font-size: 16px;
                cursor: pointer;
                text-decoration: none;
                text-align: center;
                transition: background-color 0.3s ease, transform 0.3s ease;
            }

            .back-to-home:hover {
                background: #E68E8E; /* Hover color */
                transform: scale(1.05);
            }

    </style>
</head>
<body>
<a href="home.php" class="back-to-home">Back to Home</a>
    <div class="form-container">
        <div class="form-header">
            Welcome
        </div>
        <div class="form-section">
            <h2>Tenant Login</h2>
            <form action="taut.php" method="post">
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
