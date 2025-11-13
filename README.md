# Online RSVP System (RSVP-website)

An **Online RSVP (Respond to Invitation)** web application built in PHP that allows users to sign up, log in, view events, RSVP, and receive email notifications.  
This project helps streamline managing RSVPs, guest attendance tracking, and emailing within events.

## 🚀 Features

- User registration & login system (with sessions & basic authentication)  
- Event viewing page for users  
- RSVP submission and email notification after RSVP  
- Admin-style event creation and management (if applicable)  
- Email sending via built-in PHP mailer (or configured mail library)  
- Clear separation of files: includes folder for reusable functions/config, main pages for user flows  

## 🛠 Tech Stack

- **Frontend**: HTML + CSS + (possibly basic layout animations/gifs)  
- **Backend**: PHP  
- **Emailing**: PHP mail function or a mail library (e.g., PHPMailer) included in the “PHPMailer” folder.  
- **Database**: MySQL or another relational database accessed via PHP (`includes/` directory likely contains `config.php` etc.)  
- **Hosting/Environment**: Local PHP server (XAMPP/LAMP) or deployed on a PHP-enabled host  

## 📂 Project Structure

RSVP-website/
│
├── index.php # Homepage / landing page
├── landingPage.php # After login landing dashboard
├── login.php # Login form
├── signup.php # User registration form
├── logout.php # Logout script
├── send_email.php # Email-notification logic
├── event.gif # Graphic for events page
├── people.png # Graphic icon for users/attendees
├── includes/ # Shared config, functions, database connection
│ ├── config.php # DB connection & site-wide config
│ └── functions.php # Reusable helper functions
├── PHPMailer/ # Mail library (if used)
└── … # Plus any other folders/files

bash
Copy code

## ⚙️ Installation & Setup

1. **Clone the repository**  
   ```bash
   git clone https://github.com/Raman-954/RSVP-website.git
Copy to server directory (e.g., htdocs/RSVP-website for XAMPP, or your host’s public_html folder)

Create database

Use phpMyAdmin or MySQL CLI

Create a new database, e.g., rsvp_db

Import any provided SQL file (if the repo includes one) or manually create tables: users, events, rsvp

Configure database connection

Open includes/config.php

Set your database credentials:

php
Copy code
$host = 'localhost';
$user = 'your_db_username';
$pass = 'your_db_password';
$dbname = 'rsvp_db';
$conn = mysqli_connect($host, $user, $pass, $dbname);
Ensure emailing works

If using PHPMailer, configure SMTP credentials in send_email.php or the library config

Test sending a test email to confirm setup

Run the application

Open in browser: http://localhost/RSVP-website/

Register a user, login, view events, RSVP, check email

👩‍💻 Usage Workflow
User:

Visit the signup page → create account

Log in → view available events on landingPage

Select/RSVP to event → receive confirmation email

Optionally log out

Admin (if implemented):

Log in with admin account

Create/edit/delete events

View list of RSVPs and send follow-up emails

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

🧾 Future Enhancements
Add admin user management (create/manage admin accounts)

Enhance UI/UX with responsive design (mobile friendly)

Add analytics dashboard (number of RSVPs by event, status breakdown)

Add email reminders before event date

Integrate QR code check-in for events

Allow multiple event categories or image uploads for events

💡 Learning Outcomes
Develop a full-stack web application with PHP & MySQL

Handle user authentication, sessions, and CRUD operations

Implement email notifications via PHP/PHPMailer

Design database schema and use relational connections

Integrate frontend and backend for real-world event RSVP use case

🧑‍💻 Author
Raman Kumar
📧 raman2511kumar@gmail.com
🌐 GitHub: Raman-954

🪪 License
This project is licensed under the MIT License (or specify whichever you use).
