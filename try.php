<?php
include_once 'connect.php';
session_start();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monthly Bills</title>
    <link rel="stylesheet" href="try.css"> 
</head>
<body>
    <div class="container">
        <div class="sidebar">
        <div class="URent">
            <img src="urentlogo.png" alt="logo Image">
            <p class="logo-text">URent</p>
                <p><?php echo $_SESSION['user'];?></p>
            </div>
            <ul>
                <li><a href="lldb.php">Dashboard</a></li>
                <li><a href="llmb.php" class="active">Monthly Bills</a></li>
                <li><a href="tenants.php">Tenants</a></li>
                <li><a href="lllogout.php">Log out</a></li>
            </ul>
        </div>
        <div class="main-content">
            <h2>Monthly Bills</h2>
            
            <div class="header">
        <h2>Bills Overview</h2>
        <div class="year-month">
            <span>Year: 2024</span> |
            <span>Month: June</span>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Tenants</th>
                <th>Electricity Bill Status</th>
                <th>Water Bill Status</th>
                <th>Rental Bills</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Room 1</td>
                <td class="paid"><select>
                        <option class="paid" value="paid" selected>Paid</option>
                        <option class="not-paid" value="not-paid">Unpaid</option>
                    </select></td>
                 <td class="paid"><select>
                        <option class="paid" value="paid" selected>Paid</option>
                        <option class="not-paid" value="not-paid">Unpaid</option>
                    </select></td>
                 <td class="paid"><select>
                        <option class="paid" value="paid" selected>Paid</option>
                        <option class="not-paid" value="not-paid">Unpaid</option>
                    </select></td>
            </tr>
            <tr>
                <td>Room 2</td>
                 <td class="paid"><select>
                        <option class="paid" value="paid" selected>Paid</option>
                        <option class="not-paid" value="not-paid">Unpaid</option>
                    </select></td>
                 <td class="paid"><select>
                        <option class="paid" value="paid" selected>Paid</option>
                        <option class="not-paid" value="not-paid">Unpaid</option>
                    </select></td>
                 <td class="paid"><select>
                        <option class="paid" value="paid" selected>Paid</option>
                        <option class="not-paid" value="not-paid">Unpaid</option>
                    </select></td>
            </tr>
            <tr>
                <td>Room 3</td>
                 <td class="paid"><select>
                        <option class="paid" value="paid" selected>Paid</option>
                        <option class="not-paid" value="not-paid">Unpaid</option>
                    </select></td>
                 <td class="paid"><select>
                        <option class="paid" value="paid" selected>Paid</option>
                        <option class="not-paid" value="not-paid">Unpaid</option>
                    </select></td>
                    <td class="paid"><select>
                        <option class="paid" value="paid" selected>Paid</option>
                        <option class="not-paid" value="not-paid">Unpaid</option>
                    </select></td>
            </tr>
            <tr>
                <td>Room 4</td>
                 <td class="paid"><select>
                        <option class="paid" value="paid" selected>Paid</option>
                        <option class="not-paid" value="not-paid">Unpaid</option>
                    </select></td>
                 <td class="paid"><select>
                        <option class="paid" value="paid" selected>Paid</option>
                        <option class="not-paid" value="not-paid">Unpaid</option>
                    </select></td>
                 <td class="paid"><select>
                        <option class="paid" value="paid" selected>Paid</option>
                        <option class="not-paid" value="not-paid">Unpaid</option>
                    </select></td>
            </tr>
            <tr>
                <td>Room 5</td>
                <td class="paid"><select>
                        <option class="paid" value="paid" selected>Paid</option>
                        <option class="not-paid" value="not-paid">Unpaid</option>
                    </select></td>
                 <td class="paid"><select>
                        <option class="paid" value="paid" selected>Paid</option>
                        <option class="not-paid" value="not-paid">Unpaid</option>
                    </select></td>
                 <td class="paid"><select>
                        <option class="paid" value="paid" selected>Paid</option>
                        <option class="not-paid" value="not-paid">Unpaid</option>
                    </select></td>
            </tr>
            <tr>
                <td>Room 6</td>
                 <td class="paid"><select>
                        <option class="paid" value="paid" selected>Paid</option>
                        <option class="not-paid" value="not-paid">Unpaid</option>
                    </select></td>
                <td class="paid"><select>
                        <option class="paid" value="paid" selected>Paid</option>
                        <option class="not-paid" value="not-paid">Unpaid</option>
                    </select></td>
                <td class="paid"><select>
                        <option class="paid" value="paid" selected>Paid</option>
                        <option class="not-paid" value="not-paid">Unpaid</option>
                    </select></td>
            </tr>
        </tbody>
    </table>
</body>
</html>
