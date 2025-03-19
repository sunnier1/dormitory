<?php include 'sidebar.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dormitory Management Dashboard</title>
    <style>
        .content {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin: 15% 13%;
        }

        .dash-picture {
            flex: 1;
        }

        .dash-picture img {
            border-radius: 12px;
            height: 500px;
            width: 100%;
            max-width: 500px;
            opacity: 0;
            animation: fadeIn 2s ease-out forwards, slideRight 2s forwards;
            box-shadow: 18px 12px 28px rgba(0, 0, 0.5, 0.5);
        }

        .text-content {
            flex: 2;
            margin-top: -120px;
            animation: slideLeft 2s ease-out forwards;
        }

        h1 {
            font-family: 'Courier New', Courier, monospace;
            font-size: 56px;
            text-shadow: 2px 2px 8px rgba(0, 0.2, 0, 0.3);
        }

        p {
            width: 100%;
            line-height: 60px;
            text-align: justify;
            text-align: center;
            font-family: 'Courier New', Courier, monospace;
        }

        .introduction-section,
        .staff-section {
            margin: 8% 13%;
        }

        .introduction-section h2,
        .staff-section h2, .staff-section p{
            text-align:center;
            font-family: 'Courier New', Courier, monospace;
            color: #333;
        }

        .staff-section img {
            border-radius: 12px;
            width: 100%;
            max-width: 600px;
            display: block;
            margin: 0 auto;
            box-shadow: 2px 2px 5px rgba(0, 0, 0.8, 0.3);
        }

        .staff-motto {
            text-align: center;
            font-size: 18px;
            color: #666;
            margin-top: 10px;
        }

        .copyright-section {
            text-align: center;
            font-size: 14px;
            color: #666;
            margin-top: 40px;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
            }
        }

        @keyframes slideRight {
            from {
                transform: translateX(0);
            }
            to {
                transform: translateX(10%);
            }
        }

        @keyframes slideLeft {
            from {
                transform: translateX(100%);
                transform: rotate(20%);
            }
            to {
                transform: translateX(20%);
            }
        }

        
    </style>
</head>
<body>

    <div class="content">
        <div class="dash-picture">
            <img src="assets/residence.jpg" alt="Dormitory">
        </div>
        <div class="text-content">
            <h1>Residence Management Dashboard</h1>
            <p>Welcome to the Dormitory Management Dashboard. Here, you can manage all aspects of dormitory life, from room assignments to maintenance requests. Stay organized and keep everything running smoothly.</p>
        </div>
    </div>

    <hr>

    <div class="introduction-section">
        <h2>About the Website</h2>
        <p>This website is designed to streamline the management of dormitories, providing a centralized platform for administrators and residents alike. Features include room assignments, maintenance tracking, and communication tools.</p>
    </div>

    <div class="staff-section">
        <h2>Meet Our Staff</h2>
        <img src="assets/staff.jpg" alt="Our Staff">
        <div class="staff-motto">
            <p>"Dedicated to providing the best living experience for our residents."</p>
        </div>
    </div>

    <div class="copyright-section">
        &copy; 2023 Lispita_. All rights reserved. Contact me at <a href="mailto:lilispitasari@gmail.com">lilispitasari@gmail.com</a>
    </div>

</body>

</html>
