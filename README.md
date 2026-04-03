# PHP Machine Test – Business Rating System

## Description

This project is a simple **Business Rating System** built using **Core PHP and MySQL**.
It allows users to manage business records with basic CRUD functionality.

## Features

* Add Business
* Edit Business
* Delete Business
* List Businesses
* Form Validation using jQuery
* Bootstrap Modal for Add/Edit

## Requirements

* PHP 8.0+
* MySQL / MariaDB
* Apache Server
* XAMPP / WAMP 

---

# Setup Instructions

## 1. Clone or Download Project

Download the project or clone it using Git.

```
git clone https://github.com/sachinshindepatil/business-rating-system.git
```

---

# Windows Setup (XAMPP / WAMP)

## Step 1: Copy Project

Copy the project folder to:

```
C:\xampp\htdocs\
```

Example:

```
C:\xampp\htdocs\business-rating-system
```

---

## Step 2: Import Database

1. Open **phpMyAdmin**
2. Create a new database:

```
business_rating
```

3. Import the file:

```
database.sql
```

---

## Step 3: Configure Database

Open:

```
config/database.php
```

Update credentials if needed:

```php
$host = "localhost";
$user = "root";
$password = "";
$database = "business_rating";
```

---

## Step 4: Run Project

Open browser:

```
http://localhost/business-rating-system
```

---

# Apache Virtual Host Setup (Optional – Recommended)

Using virtual host allows you to access the project like a real domain.

Example:

```
http://local.businessrate.com/
```

---

## Step 1: Edit Hosts File

Open:

```
C:\Windows\System32\drivers\etc\hosts
```

Add:

```
127.0.0.1 local.businessrate.com
```

---

## Step 2: Configure Apache Virtual Host

Open:

```
xampp/apache/conf/extra/httpd-vhosts.conf
```

Add:

```
<VirtualHost *:80>
    ServerName local.businessrate.com
    DocumentRoot "C:/xampp/htdocs/business-rating-system"

    <Directory "C:/xampp/htdocs/business-rating-system">
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

---

## Step 3: Restart Apache

Restart Apache from XAMPP control panel.

Open in browser:

```
http://local.businessrate.com
```

---

# Folder Structure

```
business-rating-system
│
├── assets
├── config
├── controllers
├── includes
├── models
├── api.php
├── business_listing.php
├── database.sql
├── index.php
└── README.md
└── routes.php
```

---

# Author

**Sachin Shinde**

PHP Developer / Laravel Developer
