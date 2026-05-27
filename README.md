# Hotel Website Management System

A modern and responsive **Hotel Booking & Management Website** built using **PHP, MySQL, Bootstrap, JavaScript, and AJAX**.
This project includes both a **Frontend User Panel** and an **Admin Dashboard** for managing rooms, facilities, bookings, and website settings.

---

# Features

## Frontend Features

* Responsive modern UI
* Browse hotel rooms
* Room details with images
* Filter/search rooms
* Contact form
* About page
* Facilities section
* User-friendly navigation
* Mobile responsive design

## Admin Panel Features

* Secure admin login
* Add / edit / delete rooms
* Manage room images
* Manage facilities & features
* Website settings control
* Contact queries management
* Team management
* Dynamic content updates
* Database-driven system

---

# Tech Stack

| Technology  | Usage               |
| ----------- | ------------------- |
| PHP         | Backend Development |
| MySQL       | Database            |
| Bootstrap 5 | UI Design           |
| JavaScript  | Interactivity       |
| AJAX        | Dynamic Requests    |
| HTML5       | Structure           |
| CSS3        | Styling             |

---

# Project Structure

```bash
hotelwebsite/
│
├── admin/
│   ├── dashboard.php
│   ├── rooms.php
│   ├── settings.php
│   └── ...
│
├── inc/
│   ├── db_config.php
│   ├── essentials.php
│   └── links.php
│
├── images/
├── css/
├── js/
├── index.php
├── rooms.php
├── facilities.php
├── contact.php
└── README.md
```

---

# Database Schema

The project uses custom primary keys with `sr_no`.

## Main Tables

* `rooms`
* `room_features`
* `room_facilities`
* `room_images`
* `features`
* `facilities`
* `admin_cred`
* `settings`
* `contact_details`
* `team_details`
* `user_queries`

---

# Installation Guide

## 1. Clone Repository

```bash
git clone https://github.com/your-username/hotelwebsite.git
```

## 2. Move Project

Move the project folder into:

```bash
xampp/htdocs/
```

## 3. Start XAMPP

Start:

* Apache
* MySQL

## 4. Create Database

Open:

```bash
http://localhost/phpmyadmin
```

Create database:

```sql
hotelwebsite
```

Import the SQL file.

## 5. Run Project

```bash
http://localhost/hotelwebsite
```

---

# Screen Recordings

## Frontend Screen Recording


```md
[Frontend Demo Video](https://github.com/user-attachments/assets/16680a5c-98cc-49b7-bf4b-c18baba2095b)

---

## Backend/Admin Panel Screen Recording

```md
[Backend Demo Video](https://github.com/user-attachments/assets/7058b6ed-34f6-465f-ba82-045f051f5eeb)
```
---

# Future Improvements

* Online room booking
* Payment gateway integration
* User authentication
* Booking history
* Email notifications
* Dark mode
* Reviews & ratings
* Availability calendar

---


# Author

## Sujal Purohit

* GitHub: [https://github.com/sujall-purohit](https://github.com/sujall-purohit)
* LinkedIn: https://www.linkedin.com/in/sujal-purohit-aa53ba275/

---

# Support

If you like this project, give it a ⭐ on GitHub.
