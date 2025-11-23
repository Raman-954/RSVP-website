# 💌 RSVP-website: Online Event RSVP System

A modern and efficient **Online RSVP (Respond to Invitation)** web application built with **PHP and MySQL** that allows users to seamlessly sign up, log in, view events, submit their RSVPs, and receive instant email confirmations. This project is designed to streamline event management, guest attendance tracking, and communication.

## 🌟 Key Features

| Icon | Feature | Description |
| :---: | :--- | :--- |
| 🔑 | **User Authentication** | Secure registration and login system utilizing PHP sessions and basic authentication. |
| 🗓️ | **Event Viewing** | Dedicated page for logged-in users to browse available events. |
| ✅ | **RSVP Submission** | Easy submission of 'Yes/No/Maybe' responses to events. |
| 📧 | **Email Notifications** | Automated confirmation emails sent after a successful RSVP using PHPMailer or built-in functions. |
| 🧑‍💻 | **Admin Management** | (If applicable) Functionality for event creation, editing, and deletion by administrators. |
| 📂 | **Clean Architecture** | Clear separation of concerns with an `includes/` folder for reusable config and functions. |

## 🛠 Tech Stack

| Category | Technology | Notes |
| :--- | :--- | :--- |
| **Backend** | PHP | Core logic and server-side processing. |
| **Database** | MySQL (or similar RDBMS) | For storing user, event, and RSVP data. |
| **Frontend** | HTML, CSS | Basic structure and styling. |
| **Emailing** | PHPMailer / PHP Mail function | For handling email deliveries. |
| **Environment**| XAMPP/LAMP | Local development setup. |

## 📁 Project Structure
```
RSVP-website/
│
├── index.php # Landing Page / Guest Entry
├── landingPage.php # User Dashboard (Post-Login)
├── login.php # Login Form
├── signup.php # User Registration Form
├── logout.php # Logout Script
├── send_email.php # Email Notification Logic
├── event.gif # Event Graphic
├── people.png # User/Attendee Icon
├── includes/
│ ├── config.php # ⚙️ DB connection & Site-wide config
│ └── functions.php # 🧩 Reusable helper functions
├── PHPMailer/ # 📧 External Mail Library (if used)
└── … # Other assets/files
```
bash
Copy code

## ⚙️ Installation & Setup

1. **Clone the repository**  
   ```bash
   git clone https://github.com/Raman-954/RSVP-website.git
Copy to server directory (e.g., htdocs/RSVP-website for XAMPP, or your host’s public_html folder)

## Create database

Use phpMyAdmin or MySQL CLI

Create a new database, e.g., rsvp_db

Import any provided SQL file (if the repo includes one) or manually create tables: users, events, rsvp

Configure database connection

Open includes/config.php

Set your database credentials:
```
php
Copy code
$host = 'localhost';
$user = 'your_db_username';
$pass = 'your_db_password';
$dbname = 'rsvp_db';
$conn = mysqli_connect($host, $user, $pass, $dbname);
Ensure emailing works
```
If using PHPMailer, configure SMTP credentials in send_email.php or the library config

Test sending a test email to confirm setup

## Run the application
```
Open in browser: http://localhost/RSVP-website/
```
Register a user, login, view events, RSVP, check email

## 👩‍💻 Usage Workflow
User:

Visit the signup page → create account

Log in → view available events on landingPage

Select/RSVP to event → receive confirmation email

Optionally log out

Admin (if implemented):

Log in with admin account

Create/edit/delete events

View list of RSVPs and send follow-up emails
```
🧩 Database Schema (Sample)
users table
Column	Type	Description
id	INT (PK)	User ID
name	VARCHAR	User’s full name
email	VARCHAR	Login email
password	VARCHAR	Hashed password
role	ENUM	e.g., ‘user’ or ‘admin’

events table
Column	Type	Description
id	INT (PK)	Event ID
title	VARCHAR	Event title
date	DATE	Event date
time	TIME	Event time
venue	VARCHAR	Event venue
description	TEXT	Event details

rsvp table
Column	Type	Description
id	INT (PK)	RSVP record ID
user_id	INT (FK)	Linked to users.id
event_id	INT (FK)	Linked to events.id
status	ENUM	‘Yes’, ‘No’, ‘Maybe’
timestamp	DATETIME	Time of submission
```
### 🧾 Future Enhancements
Add admin user management (create/manage admin accounts)

Enhance UI/UX with responsive design (mobile friendly)

Add analytics dashboard (number of RSVPs by event, status breakdown)

Add email reminders before event date

Integrate QR code check-in for events

Allow multiple event categories or image uploads for events

### 💡 Learning Outcomes
Develop a full-stack web application with PHP & MySQL

Handle user authentication, sessions, and CRUD operations

Implement email notifications via PHP/PHPMailer

Design database schema and use relational connections

Integrate frontend and backend for real-world event RSVP use case

### 🧑‍💻 Author
```
Raman Kumar
📧 raman2511kumar@gmail.com

🌐 GitHub: Raman-954
```
🪪 License
This project is licensed under the MIT License (or specify whichever you use).
