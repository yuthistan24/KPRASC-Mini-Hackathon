<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Club Hub - KEC Events Manager</title>
    <link rel="icon" type="image/x-icon" href="./images/clubhub-logo.jpg">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .page {
            display: none;
        }

        .page.active {
            display: block;
        }

        .welcome-screen {
            text-align: center;
            padding: 60px 20px;
        }

        .welcome-screen h1 {
            color: white;
            font-size: 3em;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        .welcome-screen p {
            color: white;
            font-size: 1.2em;
            margin-bottom: 40px;
        }

        .switch-form {
            text-align: center;
            margin-top: 15px;
            font-size: 0.9em;
            color: #555;
        }

        .switch-form a {
            color: #667eea;
            text-decoration: none;
            font-weight: bold;
        }

        .switch-form a:hover {
            text-decoration: underline;
        }

        /* Admin Dashboard Styles */
        .dashboard {
            background: rgba(255, 255, 255, 0.1);
            padding: 30px;
            border-radius: 15px;
            margin-top: 20px;
        }

        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .dashboard-header h2 {
            color: white;
            margin: 0;
        }

        .pending-registrations {
            background: rgba(255, 255, 255, 0.05);
            padding: 20px;
            border-radius: 10px;
        }

        .pending-registrations h3 {
            color: white;
            margin-bottom: 20px;
            text-align: center;
        }

        .tab-btn {
            padding: 10px 20px;
            background: rgba(255, 255, 255, 0.1);
            border: none;
            color: white;
            cursor: pointer;
            margin: 0 5px;
            border-radius: 5px;
        }

        .tab-btn.active {
            background: rgba(255, 255, 255, 0.3);
        }

        .tabs {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .pending-list {
            display: none;
            max-width: 800px;
            margin: 20px auto;
        }

        .pending-list.active {
            display: block;
        }

        .registration-card {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .registration-card h4 {
            color: #333;
            margin-bottom: 15px;
            font-size: 1.2em;
        }

        .registration-details {
            margin-bottom: 15px;
        }

        .registration-details p {
            margin: 5px 0;
            color: #555;
        }

        .verification-buttons {
            display: flex;
            gap: 10px;
        }

        .approve-btn {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
        }

        .reject-btn {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
        }

        .no-pending {
            text-align: center;
            color: white;
            font-style: italic;
            padding: 20px;
        }


        }

        .registration-details p {
            margin: 5px 0;
            color: #555;
        }

        .verification-buttons {
            display: flex;
            gap: 10px;
        }

        .approve-btn {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
        }

        .reject-btn {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
        }

        .no-pending {
            text-align: center;
            color: white;
            font-style: italic;
            padding: 20px;
        }

        .dashboard {
            background: rgba(255, 255, 255, 0.1);
            padding: 30px;
            border-radius: 15px;
            margin-top: 20px;
        }

        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .dashboard-header h2 {
            color: white;
            margin: 0;
        }

        .pending-registrations {
            background: rgba(255, 255, 255, 0.05);
            padding: 20px;
            border-radius: 10px;
        }

        .pending-registrations h3 {
            color: white;
            margin-bottom: 20px;
            text-align: center;
        }

        .tabs {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .club-hub-logo {
            width: 200px;
            margin-bottom: 30px;
            transition: transform 0.3s ease;
        }

        .club-hub-logo:hover {
            transform: scale(1.05);
        }

        .welcome-upcoming-title {
            margin-top: 18px;
            color: white;
        }

        .welcome-events-container {
            margin-top: 12px;
        }

        /* Image gallery on welcome page */
        .welcome-images {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 16px;
            max-width: 900px;
            margin: 0 auto 30px;
            align-items: center;
        }
        
        .welcome-images figure {
            margin: 0;
        }
        .welcome-images img {
            width: 100%;
            height: 140px;
            object-fit: cover;
            border-radius: 12px;
            border: 4px solid rgba(255,255,255,0.08);
            box-shadow: 0 6px 18px rgba(0,0,0,0.25);
            transition: transform 0.25s ease, box-shadow 0.25s ease;
            display: block;
        }
        /* Hover moves image down (translateY positive) */
        .welcome-images img:hover {
            transform: translateY(6px) scale(1.02);
            box-shadow: 0 14px 30px rgba(0,0,0,0.35);
        }
        .welcome-images figcaption {
            margin-top: 8px;
            color: rgba(255,255,255,0.95);
            font-size: 0.95em;
            text-align: center;
            line-height: 1.2;
        }

        /* Past events list styling */
        .past-events {
            max-width: 900px;
            margin: 18px auto 0;
            color: rgba(255,255,255,0.95);
            text-align: left;
            font-size: 0.95em;
        }
        .past-events h4 {
            margin-bottom: 8px;
            color: rgba(255,255,255,0.98);
        }
        .past-events ul {
            list-style: none;
            padding: 0;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 8px 16px;
        }
        .past-events li {
            background: rgba(255,255,255,0.08);
            padding: 8px 12px;
            border-radius: 8px;
        }

        .role-buttons {
            display: flex;
            gap: 30px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .role-section {
            display: flex;
            flex-direction: column;
            gap: 15px;
            align-items: center;
        }

        .role-btn {
            background: white;
            color: #667eea;
            padding: 30px 50px;
            border: none;
            border-radius: 15px;
            font-size: 1.3em;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
            width: 100%;
        }

        .register-btn {
            background: transparent;
            color: white;
            padding: 15px 30px;
            border: 2px solid white;
            border-radius: 10px;
            font-size: 1em;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s;
            width: 100%;
        }

        .register-btn:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateY(-2px);
        }

        .role-btn:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.4);
        }

        .login-container {
            background: white;
            border-radius: 20px;
            padding: 40px;
            max-width: 400px;
            margin: 50px auto;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }

        .login-container h2 {
            color: #667eea;
            margin-bottom: 30px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 500;
        }

        .form-group input, .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1em;
            transition: border 0.3s;
            font-family: inherit;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 80px;
        }

        .form-group input:focus, .form-group textarea:focus {
            outline: none;
            border-color: #667eea;
        }

        .btn {
            width: 100%;
            padding: 12px;
            background: #667eea;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1.1em;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn:hover {
            background: #5568d3;
        }

        .back-btn {
            background: #e0e0e0;
            color: #333;
            margin-top: 10px;
        }

        .back-btn:hover {
            background: #d0d0d0;
        }

        .dashboard {
            background: white;
            border-radius: 20px;
            padding: 30px;
            min-height: 80vh;
        }

        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #e0e0e0;
        }

        .dashboard-header h2 {
            color: #667eea;
        }

        .admin-actions {
            display: flex;
            gap: 10px;
        }

        .reset-btn {
            background: #fd7e14;
        }

        .reset-btn:hover {
            background: #e67300;
        }

        .logout-btn {
            padding: 10px 20px;
            background: #ff6b6b;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
        }

        .logout-btn:hover {
            background: #ff5252;
        }

        .event-form {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 12px;
            margin-bottom: 30px;
        }

        .event-form h3 {
            margin-bottom: 20px;
            color: #333;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 15px;
        }

        .events-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .event-card {
            background: white;
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            padding: 20px;
            transition: all 0.3s;
        }

        .event-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .event-card h4 {
            color: #667eea;
            margin-bottom: 10px;
        }

        .event-card p {
            color: #666;
            margin: 8px 0;
            font-size: 0.95em;
        }

        .event-card .event-date {
            color: #ff6b6b;
            font-weight: bold;
        }

            .event-card .event-time {
                color: #40c057;
                font-weight: 600;
                margin: 8px 0;
            }

        .event-actions {
            margin-top: 15px;
            display: flex;
            gap: 10px;
        }

        #posterPreview {
            margin-top: 10px;
            max-width: 300px;
            border-radius: 8px;
            overflow: hidden;
        }

        #posterPreview img {
            max-width: 100%;
            display: block;
            border-radius: 8px;
        }

        input[type="file"] {
            padding: 10px;
            border: 2px dashed #e0e0e0;
            border-radius: 8px;
            width: 100%;
            cursor: pointer;
        }

        input[type="file"]:hover {
            border-color: #667eea;
        }

        .join-btn, .delete-btn {
            padding: 8px 15px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            flex: 1;
        }

        .join-btn {
            background: #51cf66;
            color: white;
        }

        .join-btn:hover {
            background: #40c057;
        }

        .join-btn.joined {
            background: #adb5bd;
            cursor: not-allowed;
        }

        .delete-btn {
            background: #ff6b6b;
            color: white;
        }

        .delete-btn:hover {
            background: #ff5252;
        }

        .participants-count {
            background: #667eea;
            color: white;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.85em;
            display: inline-block;
            margin-top: 10px;
        }

        .error-msg {
            color: #ff6b6b;
            text-align: center;
            margin-top: 10px;
        }

        .info-box {
            background: #e7f5ff;
            border-left: 4px solid #339af0;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 8px;
        }

        .info-box p {
            color: #1864ab;
            margin: 5px 0;
            font-size: 0.9em;
        }

        /* Admin styles */
        .admin-section {
            margin-top: 20px;
            width: 100%;
            text-align: center;
        }

        .admin-btn {
            background: #9775fa;
        }

        .admin-btn:hover {
            background: #845ef7;
        }

        .pending-registrations {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 20px;
            margin-top: 20px;
        }

        .tabs {
            display: flex;
            gap: 10px;
            margin: 20px 0;
        }

        .tab-btn {
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            background: #e9ecef;
            color: #495057;
            transition: all 0.3s;
        }

        .tab-btn.active {
            background: #667eea;
            color: white;
        }

        .pending-list {
            display: none;
        }

        .pending-list.active {
            display: block;
        }

        .registration-card {
            background: white;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 15px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .registration-card h4 {
            color: #667eea;
            margin-bottom: 10px;
        }

        .registration-details {
            margin: 10px 0;
            color: #495057;
        }

        .verification-buttons {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }

        .approve-btn {
            padding: 8px 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            background: #40c057;
            color: white;
            transition: all 0.3s;
        }

        .reject-btn {
            padding: 8px 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            background: #ff6b6b;
            color: white;
            transition: all 0.3s;
        }

        .hidden {
            display: none;
        }

        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
            }
            
            .events-grid {
                grid-template-columns: 1fr;
            }
            
            .welcome-screen h1 {
                font-size: 2em;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div id="welcomePage" class="page active">
            <div class="welcome-screen">    
                <img src="./images/clubhub-logo.jpg" alt="Club Hub Logo" class="club-hub-logo">
                <h1>Welcome to Club Hub</h1>
                <p>Discover and join events hosted by clubs at Kongu Engineering College (KEC)</p>
                <div class="welcome-images" aria-hidden="false">
                        <figure>
                            <img src="https://images.unsplash.com/photo-1511632765486-a01980e01a18?auto=format&fit=crop&w=800&q=60" alt="Technology Workshop">
                            <figcaption>Tech Club — AI Workshop & Hackathon (Oct 2025)</figcaption>
                        </figure>
                        <figure>
                            <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=800&q=60" alt="Literature Club Meeting">
                            <figcaption>Literature Club — Poetry Evening (Sept 2025)</figcaption>
                        </figure>
                        <figure>
                            <img src="https://images.unsplash.com/photo-1494059980473-813e73ee784b?auto=format&fit=crop&w=800&q=60" alt="Dance Performance">
                            <figcaption>Dance Club — Annual Dance Show (Aug 2025)</figcaption>
                        </figure>
                </div>

                    <div class="past-events" aria-label="Past events history">
                        <h4>Past Events</h4>
                        <ul>
                            <li><strong>Photography Club</strong> — Nature Photography Workshop — Oct 2025</li>
                            <li><strong>Music Club</strong> — Open Mic Night & Jam Session — Sept 2025</li>
                            <li><strong>Math Club</strong> — Number Theory Guest Lecture — Aug 2025</li>
                        </ul>
                    </div>

                    <h4 class="welcome-upcoming-title">Upcoming Events</h4>
                    <div id="welcomeEvents" class="events-grid welcome-events-container"></div>

                <div class="role-buttons">
                    <div class="role-section">
                        <button class="role-btn" onclick="showLogin('student')">👨‍🎓 Student Login</button>
                        <button class="register-btn" onclick="showRegister('student')">Register as Student</button>
                    </div>
                    <div class="role-section">
                        <button class="role-btn" onclick="showLogin('manager')">👨‍💼 Manager Login</button>
                        <button class="register-btn" onclick="showRegister('manager')">Register as Manager</button>
                    </div>
                    <div class="role-section admin-section">
                        <button class="role-btn admin-btn" onclick="showLogin('admin')">👑 Admin Login</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="studentLogin" class="page">
            <div class="login-container">
                <h2>Student Login</h2>
                <form onsubmit="login(event, 'student')">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" id="studentUsername" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" id="studentPassword" required>
                    </div>
                    <button type="submit" class="btn">Login</button>
                    <button type="button" class="btn back-btn" onclick="showWelcome()">Back</button>
                    <p class="switch-form">
                        New student? <a href="#" onclick="showRegister('student'); return false;">Register here</a>
                    </p>
                    <p class="error-msg" id="studentError"></p>
                </form>
            </div>
        </div>

        <div id="managerLogin" class="page">
            <div class="login-container">
                <h2>Manager Login</h2>
                <form onsubmit="login(event, 'manager')">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" id="managerUsername" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" id="managerPassword" required>
                    </div>
                    <button type="submit" class="btn">Login</button>
                    <button type="button" class="btn back-btn" onclick="showWelcome()">Back</button>
                    <p class="switch-form">
                        New manager? <a href="#" onclick="showRegister('manager'); return false;">Register here</a>
                    </p>
                    <p class="error-msg" id="managerError"></p>
                </form>
            </div>
        </div>

        <div id="studentDashboard" class="page">
            <div class="dashboard">
                <div class="dashboard-header">
                    <h2>Welcome, <span id="studentName"></span>! 👋</h2>
                    <button class="logout-btn" onclick="logout()">Logout</button>
                </div>
                <h3>Upcoming Events</h3>
                <div id="studentEvents" class="events-grid"></div>
            </div>
        </div>

        <div id="managerDashboard" class="page">
            <div class="dashboard">
                <div class="dashboard-header">
                    <h2>Manager Dashboard</h2>
                    <button class="logout-btn" onclick="logout()">Logout</button>
                </div>
                
                <div class="event-form">
                    <h3>Create New Event</h3>
                    <form onsubmit="createEvent(event)">
                        <div class="form-row">
                            <div class="form-group">
                                <label>Club Name</label>
                                <input type="text" id="eventClub" required placeholder="e.g., Tech Club, Music Club">
                            </div>
                            <div class="form-group">
                                <label>Event Name</label>
                                <input type="text" id="eventName" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label>Date</label>
                                <input type="date" id="eventDate" required>
                            </div>
                            <div class="form-group">
                                <label>Location</label>
                                <input type="text" id="eventLocation" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label>Start Time</label>
                                <input type="time" id="eventStartTime" required>
                            </div>
                            <div class="form-group">
                                <label>End Time</label>
                                <input type="time" id="eventEndTime" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Event Poster</label>
                            <input type="file" id="eventPoster" accept="image" required>
                            <div id="posterPreview"></div>
                        </div>

                        <div class="form-group">
                            <label>Description</label>
                            <textarea id="eventDescription" required></textarea>
                        </div>
                        <button type="submit" class="btn">Create Event</button>
                    </form>
                </div>

                <h3>All Events</h3>
                <div id="managerEvents" class="events-grid"></div>
            </div>
        </div>

        <!-- Student Registration -->
        <div id="studentRegister" class="page">
            <div class="login-container">
                <h2>Student Registration</h2>
                <form onsubmit="register(event, 'student')">
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" id="studentRegName" required>
                    </div>
                    <div class="form-group">
                        <label>Roll Number</label>
                        <input type="text" id="studentRegRoll" required>
                    </div>
                    <div class="form-group">
                        <label>Department</label>
                        <select id="studentRegDept" required class="form-control">
                            <option value="">Select Department</option>
                            <option value="CSE">Computer Science and Engineering</option>
                            <option value="ECE">Electronics and Communication Engineering</option>
                            <option value="EEE">Electrical and Electronics Engineering</option>
                            <option value="MECH">Mechanical Engineering</option>
                            <option value="CIVIL">Civil Engineering</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" id="studentRegUsername" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" id="studentRegPassword" required>
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" id="studentRegConfirmPassword" required>
                    </div>
                    <button type="submit" class="btn">Register</button>
                    <button type="button" class="btn back-btn" onclick="showWelcome()">Back</button>
                        <p class="switch-form">
                            Already registered? <a href="#" onclick="showLogin('student'); return false;">Login here</a>
                        </p>
                    <p class="error-msg" id="studentRegError"></p>
                </form>
            </div>
        </div>

        <!-- Manager Registration -->
        <div id="managerRegister" class="page">
            <div class="login-container">
                <h2>Manager Registration</h2>
                <form onsubmit="register(event, 'manager')">
                    <div class="form-group">
                        <label for="managerRegName">Full Name</label>
                        <input type="text" id="managerRegName" required title="Enter your full name">
                    </div>
                    <div class="form-group">
                        <label for="managerRegEmpId">Employee ID</label>
                        <input type="text" id="managerRegEmpId" required title="Enter your employee ID">
                    </div>
                    <div class="form-group">
                        <label for="managerRegDept">Department</label>
                        <select id="managerRegDept" required class="form-control" title="Select your department">
                            <option value="">Select Department</option>
                            <option value="CSE">Computer Science and Engineering</option>
                            <option value="ECE">Electronics and Communication Engineering</option>
                            <option value="EEE">Electrical and Electronics Engineering</option>
                            <option value="MECH">Mechanical Engineering</option>
                            <option value="CIVIL">Civil Engineering</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="managerRegClub">Club Name</label>
                        <input type="text" id="managerRegClub" required placeholder="e.g., Tech Club, Music Club">
                    </div>
                    <div class="form-group">
                        <label for="managerRegUsername">Username</label>
                        <input type="text" id="managerRegUsername" required title="Choose a username">
                    </div>
                    <div class="form-group">
                        <label for="managerRegPassword">Password</label>
                        <input type="password" id="managerRegPassword" required title="Choose a password">
                    </div>
                    <div class="form-group">
                        <label for="managerRegConfirmPassword">Confirm Password</label>
                        <input type="password" id="managerRegConfirmPassword" required title="Confirm your password">
                    </div>
                    <button type="submit" class="btn">Register</button>
                    <button type="button" class="btn back-btn" onclick="showWelcome()">Back</button>
                        <p class="switch-form">
                            Already registered? <a href="#" onclick="showLogin('manager'); return false;">Login here</a>
                        </p>
                    <p class="error-msg" id="managerRegError"></p>
                </form>
            </div>
        </div>

        <!-- Admin Login -->

        <div id="adminLogin" class="page">
            <div class="login-container">
                <h2>Admin Login</h2>
                <form onsubmit="login(event, 'admin')">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" id="adminUsername" required title="Admin username">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" id="adminPassword" required title="Admin password">
                    </div>
                    <button type="submit" class="btn">Login</button>
                    <button type="button" class="btn back-btn" onclick="showWelcome()">Back</button>
                    <p class="error-msg" id="adminError"></p>
                </form>
            </div>
        </div>

        <!-- Admin Dashboard -->
        <div id="adminDashboard" class="page">
            <div class="dashboard">
                <div class="dashboard-header">
                    <h2>Admin Dashboard</h2>
                    <div class="admin-actions">
                        <button class="btn reset-btn" onclick="resetDatabase()">Reset Database</button>
                        <button class="btn" onclick="logout()">Logout</button>
                    </div>
                </div>

                <div class="pending-registrations">
                    <div class="tabs">
                        <button class="tab-btn active" onclick="showPendingTab('student')">Students</button>
                        <button class="tab-btn" onclick="showPendingTab('manager')">Managers</button>
                    </div>

                    <div id="pendingStudents" class="pending-list active"></div>
                    <div id="pendingManagers" class="pending-list"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // ============================================
        // LOCALSTORAGE DATABASE FUNCTIONS
        // ============================================
        
        const DB = {
            // Save data to localStorage
            save: function(key, data) {
                try {
                    localStorage.setItem(key, JSON.stringify(data));
                } catch (e) {
                    console.error('Error saving to localStorage:', e);
                }
            },

            // Load data from localStorage
            load: function(key, defaultValue) {
                try {
                    const data = localStorage.getItem(key);
                    return data ? JSON.parse(data) : defaultValue;
                } catch (e) {
                    console.error('Error loading from localStorage:', e);
                    return defaultValue;
                }
            },

            // Reset database to initial state
            reset: function() {
                localStorage.clear();
                this.init();
            },

        // Initialize database with default data if empty
            init: function() {
                // Default users/events data
                const defaultUsers = {
                    admin: { 'admin': 'admin123' },
                    students: {
                        'student1': 'pass123',
                        'john': 'john123',
                        'alice': 'alice123'
                    },
                    managers: {
                        'manager1': 'admin123'
                    }
                };

                if (!localStorage.getItem('mathclub_users')) {
                    this.save('mathclub_users', defaultUsers);
                }

                if (!localStorage.getItem('mathclub_pending')) {
                    this.save('mathclub_pending', { students: {}, managers: {} });
                }

                // Default events array
                const defaultEvents = [
                    {
                        id: 1,
                        name: 'AI Workshop & Hackathon',
                        club: 'Tech Club',
                        date: '2025-11-15',
                        startTime: '10:00',
                        endTime: '16:00',
                        location: 'CS Lab',
                        description: 'Learn about AI and participate in an exciting hackathon',
                        poster: 'https://images.unsplash.com/photo-1526374965328-7f61d4dc18c5?auto=format&fit=crop&w=800&q=60',
                        participants: []
                    },
                    {
                        id: 2,
                        name: 'Poetry Evening',
                        club: 'Literature Club',
                        date: '2025-11-20',
                        startTime: '17:00',
                        endTime: '19:30',
                        location: 'Main Auditorium',
                        description: 'Share and listen to original poetry compositions',
                        poster: 'https://images.unsplash.com/photo-1455541504462-57ebb2a9cec1?auto=format&fit=crop&w=800&q=60',
                        participants: []
                    },
                    {
                        id: 3,
                        name: 'Dance Workshop',
                        club: 'Dance Club',
                        date: '2025-11-25',
                        startTime: '16:00',
                        endTime: '18:00',
                        location: 'Dance Studio',
                        description: 'Learn contemporary dance moves with professional instructors',
                        poster: 'https://images.unsplash.com/photo-1508700929628-666bc8bd84ea?auto=format&fit=crop&w=800&q=60',
                        participants: []
                    },
                    {
                        id: 4,
                        name: 'Math Olympiad Training',
                        club: 'Math Club',
                        date: '2025-11-01',
                        startTime: '14:00',
                        endTime: '16:00',
                        location: 'Room 101',
                        description: 'Intensive problem-solving sessions preparing students for the national olympiad.',
                        poster: 'https://images.unsplash.com/photo-1531058020387-3be344556be6?auto=format&fit=crop&w=800&q=60',
                        participants: []
                    },
                    {
                        id: 5,
                        name: 'Calculus Workshop',
                        club: 'Math Club',
                        date: '2025-11-05',
                        startTime: '15:30',
                        endTime: '17:30',
                        location: 'Math Lab',
                        description: 'Techniques for integration, series, and problem-solving strategies.',
                        poster: 'https://images.unsplash.com/photo-1526378723159-3d8a6a7b3e6b?auto=format&fit=crop&w=800&q=60',
                        participants: []
                    },
                    {
                        id: 6,
                        name: 'Pi Day Workshop',
                        club: 'Math Club',
                        date: '2025-03-14',
                        startTime: '10:00',
                        endTime: '13:00',
                        location: 'Seminar Hall',
                        description: 'Collaborative puzzles and fun activities to celebrate Pi Day.',
                        poster: 'https://images.unsplash.com/photo-1526045612212-70caf35c14df?auto=format&fit=crop&w=800&q=60',
                        participants: []
                    },
                    {
                        id: 7,
                        name: 'Nature Photography Workshop',
                        club: 'Photography Club',
                        date: '2025-10-10',
                        startTime: '09:00',
                        endTime: '12:00',
                        location: 'Botanical Garden',
                        description: 'Outdoor session on nature photography techniques and composition.',
                        poster: 'https://images.unsplash.com/photo-1472214103451-9374bd1c798e?auto=format&fit=crop&w=800&q=60',
                        participants: []
                    }
                ];

                const currentEvents = this.load('mathclub_events', []);
                if (currentEvents.length === 0 || !localStorage.getItem('mathclub_eventIdCounter')) {
                    this.save('mathclub_events', defaultEvents);
                    this.save('mathclub_eventIdCounter', 8);
                }
            }
        };

        // Initialize database to ensure default users/events exist.
        DB.init();

        // Load data from localStorage
        let currentUser = null;
        let currentRole = null;
        let users = DB.load('mathclub_users', {
            students: {},
            managers: {},
            admin: { 'admin': 'admin123' } // Default admin credentials
        });
        let events = DB.load('mathclub_events', []);
        let eventIdCounter = DB.load('mathclub_eventIdCounter', 1);
        let pendingRegistrations = DB.load('mathclub_pending', { students: {}, managers: {} });
        
        // This ensures the initial view is populated immediately.
        document.addEventListener('DOMContentLoaded', function() {
            displayWelcomeEvents();
        });

        // ============================================
        // NAVIGATION FUNCTIONS
        // ============================================
        
        function showPage(pageId) {
            document.querySelectorAll('.page').forEach(p => p.classList.remove('active'));
            document.getElementById(pageId).classList.add('active');
            
            // Clear any error messages when switching pages
            document.querySelectorAll('.error-msg').forEach(msg => msg.textContent = '');
            
            // Reset any forms when switching pages
            document.querySelectorAll('form').forEach(form => form.reset());
        }

        function showWelcome() {
            showPage('welcomePage');
            displayWelcomeEvents();
        }

        function showLogin(role) {
            showPage(role + 'Login');
        }

        function showRegister(role) {
            showPage(role + 'Register');
        }


        function showDashboard(role) {
            showPage(role + 'Dashboard');
            if (role === 'manager') {
                displayManagerEvents();
            } else if (role === 'student') {
                displayStudentEvents();
                // Update student name in dashboard
                const studentNameSpan = document.getElementById('studentName');
                if (studentNameSpan && currentUser && currentUser.profile) {
                    studentNameSpan.textContent = currentUser.profile.name;
                }
            }
        }

        // ============================================
        // AUTHENTICATION FUNCTIONS
        // ============================================
        
        function login(e, role) {
            e.preventDefault();
            
            const errorMsg = document.getElementById(role + 'Error');
            const username = document.getElementById(role + 'Username').value;
            const password = document.getElementById(role + 'Password').value;

            if (role === 'admin') {
                // Check admin credentials
                if (!users.admin[username] || users.admin[username] !== password) {
                    errorMsg.textContent = 'Invalid admin credentials';
                    return;
                }

                currentUser = {
                    username: username,
                    role: 'admin'
                };

                // Show admin dashboard and initialize pending registrations view
                showPage('adminDashboard');
                showPendingTab('student');
                return;
            }

            

            // For students and managers
            const userList = role === 'student' ? users.students : users.managers;
            const pendingList = pendingRegistrations[role + 's'];

            // Check if registration is pending
            if (pendingList && pendingList[username]) {
                errorMsg.textContent = 'Your registration is pending approval';
                return;
            }

            // Check credentials
            if (!userList[username] || userList[username] !== password) {
                errorMsg.textContent = 'Invalid username or password';
                return;
            }

            // Store current user info
            currentUser = {
                username: username,
                role: role
            };

            // Load profile data
            const profiles = DB.load('mathclub_profiles', {});
            if (profiles[username]) {
                currentUser.profile = profiles[username];
            }

            // Show appropriate dashboard
            showDashboard(role);
            
            // Clear form and error message
            e.target.reset();
            errorMsg.textContent = '';
        }

        function logout() {
            currentUser = null;
            showWelcome();
        }

        function resetDatabase() {
            if (confirm('Are you sure you want to reset the database? This will clear all data and restore defaults.')) {
                DB.reset();
                // Reload the current data
                users = DB.load('mathclub_users', {
                    students: {},
                    managers: {},
                    admin: { 'admin': 'admin123' }
                });
                events = DB.load('mathclub_events', []);
                eventIdCounter = DB.load('mathclub_eventIdCounter', 1);
                pendingRegistrations = DB.load('mathclub_pending', { students: {}, managers: {} });
                // Update the display
                showPendingTab('student');
                alert('Database has been reset successfully.');
            }
        }

        function showPendingTab(type) {
            document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
            document.querySelector(`.tab-btn[onclick="showPendingTab('${type}')"]`).classList.add('active');
            
            document.querySelectorAll('.pending-list').forEach(list => list.classList.remove('active'));
            document.getElementById('pending' + type.charAt(0).toUpperCase() + type.slice(1) + 's').classList.add('active');
            
            displayPendingRegistrations(type);
        }

        function displayPendingRegistrations(type) {
            const container = document.getElementById('pending' + type.charAt(0).toUpperCase() + type.slice(1) + 's');
            const pendingList = pendingRegistrations[type + 's'] || {};
            
            container.innerHTML = '';
            
            if (Object.keys(pendingList).length === 0) {
                container.innerHTML = '<p class="no-pending">No pending registrations</p>';
                return;
            }

            for (const [username, profile] of Object.entries(pendingList)) {
                const card = document.createElement('div');
                card.className = 'registration-card';
                card.innerHTML = `
                    <h4>${profile.name}</h4>
                    <div class="registration-details">
                        <p><strong>Username:</strong> ${username}</p>
                        <p><strong>Department:</strong> ${profile.department}</p>
                        ${type === 'student' 
                            ? `<p><strong>Roll Number:</strong> ${profile.rollNumber}</p>`
                            : `<p><strong>Employee ID:</strong> ${profile.employeeId}</p>
                               <p><strong>Club:</strong> ${profile.club}</p>`
                        }
                        <p><strong>Registration Date:</strong> ${new Date(profile.timestamp).toLocaleDateString()}</p>
                    </div>
                    <div class="verification-buttons">
                        <button class="approve-btn" onclick="verifyRegistration('${type}', '${username}', true)">Approve</button>
                        <button class="reject-btn" onclick="verifyRegistration('${type}', '${username}', false)">Reject</button>
                    </div>
                `;
                container.appendChild(card);
            }
        }

        function verifyRegistration(type, username, approved) {
            const pendingList = pendingRegistrations[type + 's'];
            const profile = pendingList[username];
            
            if (approved) {
                // Add to active users
                const userList = type === 'student' ? users.students : users.managers;
                userList[username] = profile.password;
                
                // Save user profile
                const profiles = DB.load('mathclub_profiles', {});
                profiles[username] = profile;
                DB.save('mathclub_profiles', profiles);
                
                alert(`${type.charAt(0).toUpperCase() + type.slice(1)} registration approved for ${username}`);
            } else {
                alert(`${type.charAt(0).toUpperCase() + type.slice(1)} registration rejected for ${username}`);
            }
            
            // Remove from pending
            delete pendingList[username];
            
            // Save changes
            DB.save('mathclub_pending', pendingRegistrations);
            DB.save('mathclub_users', users);
            
            // Refresh display
            displayPendingRegistrations(type);
        }

        function register(e, role) {
            e.preventDefault();
            
            const errorMsg = document.getElementById(role + 'RegError');
            const username = document.getElementById(role + 'RegUsername').value;
            const password = document.getElementById(role + 'RegPassword').value;
            const confirmPassword = document.getElementById(role + 'RegConfirmPassword').value;
            
            // Validate passwords match
            if (password !== confirmPassword) {
                errorMsg.textContent = 'Passwords do not match';
                return;
            }

            // Check if username already exists in both active and pending users
            const userList = role === 'student' ? users.students : users.managers;
            const pendingList = pendingRegistrations[role + 's'];
            
            if (userList[username] || (pendingList && pendingList[username])) {
                errorMsg.textContent = 'Username already exists or registration is pending';
                return;
            }

            // Create user profile
            const profile = {
                name: document.getElementById(role + 'RegName').value,
                department: document.getElementById(role + 'RegDept').value,
                username: username,
                password: password,
                timestamp: new Date().toISOString()
            };

            if (role === 'student') {
                profile.rollNumber = document.getElementById('studentRegRoll').value;
            } else {
                profile.employeeId = document.getElementById('managerRegEmpId').value;
                profile.club = document.getElementById('managerRegClub').value;
            }

            // Add to pending registrations
            if (!pendingRegistrations[role + 's']) {
                pendingRegistrations[role + 's'] = {};
            }
            pendingRegistrations[role + 's'][username] = profile;
            
            // Save pending registrations
            DB.save('mathclub_pending', pendingRegistrations);
            
            // Clear form and show success message
            e.target.reset();
            alert('Registration submitted successfully! Please wait for admin approval.');
            showWelcome();
        }

        function showPendingTab(type) {
            document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
            document.querySelector(`.tab-btn[onclick="showPendingTab('${type}')"]`).classList.add('active');
            
            document.querySelectorAll('.pending-list').forEach(list => list.classList.remove('active'));
            document.getElementById('pending' + type.charAt(0).toUpperCase() + type.slice(1) + 's').classList.add('active');
            
            displayPendingRegistrations(type);
        }

        function displayPendingRegistrations(type) {
            const container = document.getElementById('pending' + type.charAt(0).toUpperCase() + type.slice(1) + 's');
            const pendingList = pendingRegistrations[type + 's'] || {};
            
            container.innerHTML = '';
            
            if (Object.keys(pendingList).length === 0) {
                container.innerHTML = '<p class="no-pending">No pending registrations</p>';
                return;
            }

            for (const [username, profile] of Object.entries(pendingList)) {
                const card = document.createElement('div');
                card.className = 'registration-card';
                card.innerHTML = `
                    <h4>${profile.name}</h4>
                    <div class="registration-details">
                        <p><strong>Username:</strong> ${username}</p>
                        <p><strong>Department:</strong> ${profile.department}</p>
                        ${type === 'student' 
                            ? `<p><strong>Roll Number:</strong> ${profile.rollNumber}</p>`
                            : `<p><strong>Employee ID:</strong> ${profile.employeeId}</p>
                               <p><strong>Club:</strong> ${profile.club}</p>`
                        }
                        <p><strong>Registration Date:</strong> ${new Date(profile.timestamp).toLocaleDateString()}</p>
                    </div>
                    <div class="verification-buttons">
                        <button class="approve-btn" onclick="verifyRegistration('${type}', '${username}', true)">Approve</button>
                        <button class="reject-btn" onclick="verifyRegistration('${type}', '${username}', false)">Reject</button>
                    </div>
                `;
                container.appendChild(card);
            }
        }

        function verifyRegistration(type, username, approved) {
            const pendingList = pendingRegistrations[type + 's'];
            const profile = pendingList[username];
            
            if (approved) {
                // Add to active users
                const userList = type === 'student' ? users.students : users.managers;
                userList[username] = profile.password;
                
                // Save user profile
                const profiles = DB.load('mathclub_profiles', {});
                profiles[username] = profile;
                DB.save('mathclub_profiles', profiles);
                
                alert(`${type.charAt(0).toUpperCase() + type.slice(1)} registration approved for ${username}`);
            } else {
                alert(`${type.charAt(0).toUpperCase() + type.slice(1)} registration rejected for ${username}`);
            }
            
            // Remove from pending
            delete pendingList[username];
            
            // Save changes
            DB.save('mathclub_pending', pendingRegistrations);
            DB.save('mathclub_users', users);
            
            // Refresh display
            displayPendingRegistrations(type);
        }

        function toggleEventParticipation(eventId, action) {
            // Reload latest events data
            events = DB.load('mathclub_events', []);
            
            const event = events.find(e => e.id === eventId);
            if (!event) return;
            
            if (action === 'join') {
                if (!event.participants.includes(currentUser.username)) {
                    event.participants.push(currentUser.username);
                    alert('Successfully joined the event!');
                }
            } else {
                event.participants = event.participants.filter(username => username !== currentUser.username);
                alert('Successfully left the event.');
            }
            
            // Save updated events back to localStorage
            DB.save('mathclub_events', events);
            
            // Refresh the display
            displayStudentEvents();
        }

        // ============================================
        // EVENT MANAGEMENT FUNCTIONS
        // ============================================
        
        // Add event listener for poster file upload
        document.getElementById('eventPoster').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('posterPreview');
                    preview.innerHTML = `<img src="${e.target.result}" alt="Preview" style="max-width: 100%; border-radius: 8px;">`;
                    preview.dataset.posterData = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });

        function createEvent(e) {
            e.preventDefault();
            
            const posterPreview = document.getElementById('posterPreview');
            const posterData = posterPreview.dataset.posterData || 'https://images.unsplash.com/photo-1511632765486-a01980e01a18?auto=format&fit=crop&w=800&q=60';
            
            const newEvent = {
                id: eventIdCounter++,
                name: document.getElementById('eventName').value,
                club: document.getElementById('eventClub').value,
                date: document.getElementById('eventDate').value,
                    startTime: document.getElementById('eventStartTime').value,
                    endTime: document.getElementById('eventEndTime').value,
                location: document.getElementById('eventLocation').value,
                description: document.getElementById('eventDescription').value,
                poster: posterData,
                participants: []
            };
            
            events.push(newEvent);
            
            // Save to localStorage
            DB.save('mathclub_events', events);
            DB.save('mathclub_eventIdCounter', eventIdCounter);
            
            e.target.reset();
            // Refresh dashboard views and welcome page
            displayManagerEvents(); 
            displayWelcomeEvents();
        }

        function deleteEvent(id) {
            if (confirm('Are you sure you want to delete this event?')) {
                events = events.filter(e => e.id !== id);
                
                // Save to localStorage
                DB.save('mathclub_events', events);
                
                // Refresh dashboard views and welcome page
                displayManagerEvents();
                displayWelcomeEvents();
            }
        }

        function cancelRegistration(eventId, username) {
            if (confirm(`Are you sure you want to cancel the registration for ${username}?`)) {
                const event = events.find(e => e.id === eventId);
                if (event) {
                    event.participants = event.participants.filter(p => p !== username);
                    
                    // Save to localStorage
                    DB.save('mathclub_events', events);
                    
                    // Refresh views
                    displayManagerEvents();
                    displayWelcomeEvents();
                }
            }
        }

        function joinEvent(id) {
            const event = events.find(e => e.id === id);
            if (event && !event.participants.includes(currentUser)) {
                event.participants.push(currentUser);
                
                // Save to localStorage
                DB.save('mathclub_events', events);
                
                // Refresh views so manager and student dashboards reflect the change
                if (currentUser.role === 'student') {
                    displayStudentEvents();
                } else if (currentUser.role === 'manager') {
                    displayManagerEvents();
                }
                displayWelcomeEvents();
            }
        }

        // ============================================
        // DISPLAY FUNCTIONS
        // ============================================
        
        function displayStudentEvents() {
            const container = document.getElementById('studentEvents');
            if (!container) return;
            
            container.innerHTML = '';
            // Always reload events from localStorage for the latest status
            events = DB.load('mathclub_events', []);
            
            if (!events || events.length === 0) {
                container.innerHTML = '<p style="text-align: center; color: #666; padding: 40px;">No events available yet. Check back soon!</p>';
                return;
            }
            
            // Sort events by date
            events.sort((a, b) => new Date(a.date) - new Date(b.date));
            
            events.forEach(event => {
                const isJoined = event.participants.includes(currentUser);
                const card = document.createElement('div');
                card.className = 'event-card';
                card.style.backgroundColor = 'white';
                card.style.border = '1px solid #e0e0e0';
                card.style.borderRadius = '12px';
                card.style.padding = '20px';
                card.style.marginBottom = '20px';
                
                card.innerHTML = `
                    <img src="${event.poster}" alt="${event.name} poster" style="width: 100%; height: 200px; object-fit: cover; border-radius: 8px; margin-bottom: 15px;">
                    <h4 style="color: #667eea; margin-bottom: 10px; font-size: 1.2em;">${event.name}</h4>
                    <p style="color: #667eea; font-weight: bold; margin-bottom: 8px;">🏛️ ${event.club || 'General Club'}</p>
                    <p class="event-date" style="color: #ff6b6b; margin-bottom: 8px;">📅 ${formatDate(event.date)}</p>
                    <p class="event-time" style="color: #40c057; margin-bottom: 8px;">⏰ ${formatTime(event.startTime)} - ${formatTime(event.endTime)}</p>
                    <p style="margin-bottom: 8px;">📍 ${event.location}</p>
                    <p style="color: #666; margin-bottom: 15px;">${event.description}</p>
                    <span class="participants-count" style="background: #667eea; color: white; padding: 5px 10px; border-radius: 20px; font-size: 0.85em;">
                        👥 ${event.participants.length} joined
                    </span>
                    <div class="event-actions" style="margin-top: 15px;">
                        <button class="join-btn ${isJoined ? 'joined' : ''}" 
                                onclick="joinEvent(${event.id})" 
                                ${isJoined ? 'disabled' : ''}
                                style="width: 100%; padding: 10px; border-radius: 8px; border: none; cursor: pointer; font-weight: bold; background-color: ${isJoined ? '#adb5bd' : '#51cf66'}; color: white;">
                            ${isJoined ? '✓ Joined' : 'Join Event'}
                        </button>
                    </div>
                `;
                container.appendChild(card);
            });
            displayWelcomeEvents(); 
        }

        // Render a simple events preview on the welcome page
        function displayWelcomeEvents() {
            const container = document.getElementById('welcomeEvents');
            if (!container) return;
            
            // Always reload events from localStorage
            events = DB.load('mathclub_events', []);
            
            container.innerHTML = '';
            
            if (events.length === 0) {
                container.innerHTML = '<p style="color: white; text-align:center; grid-column:1/-1;">No upcoming events.</p>';
                return;
            }

            // Sort events by date
            events.sort((a, b) => new Date(a.date) - new Date(b.date));

            events.forEach(event => {
                const card = document.createElement('div');
                card.className = 'event-card';
                card.innerHTML = `
                    <img src="${event.poster}" alt="${event.name} poster" class="event-thumb" style="width: 100%; height: 200px; object-fit: cover; border-radius: 8px; margin-bottom: 15px;">
                    <h4 style="color: #667eea; margin-bottom: 10px; font-size: 1.2em;">${event.name}</h4>
                    <p style="color: #667eea; font-weight: bold; margin-bottom: 8px;">🏛️ ${event.club || 'General Club'}</p>
                    <p class="event-date" style="color: #ff6b6b; margin-bottom: 8px;">📅 ${formatDate(event.date)}</p>
                    <p class="event-time" style="color: #40c057; margin-bottom: 8px;">⏰ ${formatTime(event.startTime)} - ${formatTime(event.endTime)}</p>
                    <p style="margin-bottom: 8px;">📍 ${event.location}</p>
                    <span class="participants-count" style="background: #667eea; color: white; padding: 5px 10px; border-radius: 20px; font-size: 0.85em;">👥 ${event.participants.length} joined</span>
                `;
                container.appendChild(card);
            });
        }

        function displayStudentEvents() {
            const container = document.getElementById('studentEvents');
            if (!container) return;
            
            // Always reload events from localStorage for the latest status
            events = DB.load('mathclub_events', []);
            
            container.innerHTML = '';
            
            if (!events || events.length === 0) {
                container.innerHTML = '<p class="no-events">No upcoming events available.</p>';
                return;
            }
            
            // Sort events by date
            events.sort((a, b) => new Date(a.date) - new Date(b.date));
            
            events.forEach(event => {
                const hasJoined = event.participants.includes(currentUser.username);
                const card = document.createElement('div');
                card.className = 'event-card';
                card.innerHTML = `
                    <img src="${event.poster}" alt="${event.name} poster" class="event-thumb" style="width: 100%; height: 200px; object-fit: cover; border-radius: 8px; margin-bottom: 15px;">
                    <h4 style="color: #667eea; margin-bottom: 10px; font-size: 1.2em;">${event.name}</h4>
                    <p style="color: #667eea; font-weight: bold; margin-bottom: 8px;">🏛️ ${event.club || 'General Club'}</p>
                    <p class="event-date" style="color: #ff6b6b; margin-bottom: 8px;">📅 ${formatDate(event.date)}</p>
                    <p class="event-time" style="color: #40c057; margin-bottom: 8px;">⏰ ${formatTime(event.startTime)} - ${formatTime(event.endTime)}</p>
                    <p style="margin-bottom: 8px;">📍 ${event.location}</p>
                    <p style="color: #495057; margin: 15px 0;">${event.description}</p>
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 15px;">
                        <span class="participants-count" style="background: #667eea; color: white; padding: 5px 10px; border-radius: 20px; font-size: 0.85em;">
                            👥 ${event.participants.length} joined
                        </span>
                        <button class="btn ${hasJoined ? 'leave-btn' : 'join-btn'}" 
                                onclick="toggleEventParticipation(${event.id}, '${hasJoined ? 'leave' : 'join'}')"
                                style="padding: 8px 16px; border-radius: 20px; border: none; cursor: pointer; font-weight: bold; ${hasJoined ? 'background: #ff6b6b;' : 'background: #40c057;'} color: white;">
                            ${hasJoined ? '🚪 Leave Event' : '✨ Join Event'}
                        </button>
                    </div>
                `;
                container.appendChild(card);
            });
        }

        function displayManagerEvents() {
            const container = document.getElementById('managerEvents');
            if (!container) return;
            
            container.innerHTML = '';
            // Always reload events from localStorage for the latest status
            events = DB.load('mathclub_events', []);
            
            if (!events || events.length === 0) {
                container.innerHTML = '<p style="text-align: center; color: #666; padding: 40px;">No events created yet. Create your first event above!</p>';
                return;
            }
            
            // Sort events by date
            events.sort((a, b) => new Date(a.date) - new Date(b.date));
            
            events.forEach(event => {
                const card = document.createElement('div');
                card.className = 'event-card';
                card.style.backgroundColor = 'white';
                card.style.border = '1px solid #e0e0e0';
                card.style.borderRadius = '12px';
                card.style.padding = '20px';
                card.style.marginBottom = '20px';
                
                card.innerHTML = `
                    <img src="${event.poster}" alt="${event.name} poster" style="width: 100%; height: 200px; object-fit: cover; border-radius: 8px; margin-bottom: 15px;">
                    <h4 style="color: #667eea; margin-bottom: 10px; font-size: 1.2em;">${event.name}</h4>
                    <p style="color: #667eea; font-weight: bold; margin-bottom: 8px;">🏛️ ${event.club || 'General Club'}</p>
                    <p class="event-date" style="color: #ff6b6b; margin-bottom: 8px;">📅 ${formatDate(event.date)}</p>
                    <p class="event-time" style="color: #40c057; margin-bottom: 8px;">⏰ ${formatTime(event.startTime)} - ${formatTime(event.endTime)}</p>
                    <p style="margin-bottom: 8px;">📍 ${event.location}</p>
                    <p style="color: #666; margin-bottom: 15px;">${event.description}</p>
                    <span class="participants-count" style="background: #667eea; color: white; padding: 5px 10px; border-radius: 20px; font-size: 0.85em;">
                        👥 ${event.participants.length} participants
                    </span>
                    ${event.participants.length > 0 ? `
                        <div style="margin-top: 15px; background: #f8f9fa; border-radius: 8px; padding: 15px;">
                            <h5 style="color: #495057; margin-bottom: 10px;">Participants:</h5>
                            ${event.participants.map(participant => `
                                <div style="display: flex; justify-content: space-between; align-items: center; padding: 8px; background: white; border-radius: 6px; margin-bottom: 8px;">
                                    <span style="color: #666;">${participant}</span>
                                    <button onclick="cancelRegistration(${event.id}, '${participant}')"
                                            style="padding: 5px 10px; border: none; border-radius: 4px; background: #ff6b6b; color: white; cursor: pointer; font-size: 0.9em;">
                                        Cancel Registration
                                    </button>
                                </div>
                            `).join('')}
                        </div>
                    ` : ''}
                    <div class="event-actions" style="margin-top: 15px; display: flex; gap: 10px;">
                        <button class="delete-btn" 
                                onclick="deleteEvent(${event.id})"
                                style="width: 100%; padding: 10px; border-radius: 8px; border: none; cursor: pointer; font-weight: bold; background-color: #ff6b6b; color: white;">
                            Delete Event
                        </button>
                    </div>
                `;
                container.appendChild(card);
            });
            displayWelcomeEvents(); 
        }

        // ============================================
        // UTILITY FUNCTIONS
        // ============================================
        
        function formatDate(dateStr) {
            const date = new Date(dateStr);
            const options = { year: 'numeric', month: 'long', day: 'numeric' };
            return date.toLocaleDateString('en-US', options);
        }

        function formatTime(timeStr) {
            const [hours, minutes] = timeStr.split(':');
            const hour = parseInt(hours);
            const ampm = hour >= 12 ? 'PM' : 'AM';
            const displayHour = hour % 12 || 12;
            return `${displayHour}:${minutes} ${ampm}`;
        }
    </script>
</body>
</html>