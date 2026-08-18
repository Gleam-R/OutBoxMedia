# Out-Box-Media

**Out-Box-Media** is a web-based **news and article management system** built using **Laravel and MySQL**. The application provides a platform for publishing and managing news articles across different categories while allowing registered users to interact with content through comments and ratings.

The project was developed as a learning project to explore **Laravel web development, database management, authentication, role-based access control, CRUD operations, and user activity tracking**.

> 📌 **Project Status:** Local Development / Educational Project  
> The application is currently designed to run in a local environment and has not been deployed publicly.

---

## 🚀 Project Overview

Out-Box-Media provides different levels of access depending on the user's role.

The system supports three main actors:

```text
                    Out-Box-Media
                         │
          ┌──────────────┼──────────────┐
          │              │              │
        Admin         Registered       Guest
                        User
          │              │              │
     Manage Content   Comment       Read News
     Manage Users     Rate News     Login/Register
     View Logs        Dashboard
````

The project demonstrates how a Laravel application can handle content management, authentication, user interaction, and database operations within a single web application.

---

## 👥 User Roles & Permissions

### 🔐 Admin

The Admin has full access to the management features of the system.

#### News Management

* Create news articles
* Edit existing articles
* Delete articles
* Assign articles to categories
* Upload article images

#### Category Management

* Create categories
* Edit categories
* Delete categories
* Organize news based on categories

Example categories include:

* Anime
* Politics
* Horror
* Games

#### User Management

* View registered users
* Add new users
* Edit user information
* Delete users
* Assign user roles

#### Activity Logs

Administrators can monitor user activities within the system.

Activity logs include information such as:

* User activity
* Action performed
* Timestamp

Admins can also delete activity log entries.

---

### 👤 Registered User

Registered users can interact with published news content.

Features include:

* Browse available news
* Read complete articles
* Leave comments
* Rate articles
* Access a personalized dashboard

Users can provide article ratings using a numerical scale, such as:

```text
1 — Poor
2 — Below Average
3 — Average
4 — Good
5 — Excellent
```

---

### 🌐 Guest

Guests are unauthenticated visitors who can access the public portion of the application.

Guests can:

* Browse published news
* View article details
* Browse news categories
* Access the Login page
* Access the Register page

Guests cannot perform authenticated actions such as commenting or rating articles.

---

## 🛠️ Tech Stack

### Backend

* **Laravel**
* **PHP**
* **MySQL**

### Frontend

* **HTML**
* **CSS**
* **JavaScript**
* Laravel Blade

### Development Environment

* **Composer**
* **XAMPP / MySQL**
* Laravel Artisan
* Localhost

---

## ✨ Features

### 📰 News Management

Administrators can manage the entire news collection through a dedicated management interface.

* Create articles
* Edit articles
* Delete articles
* Upload images
* Assign categories
* View publication information

### 🗂️ Category Management

News can be organized into different categories.

Administrators can:

* Add categories
* Edit categories
* Delete categories
* Assign categories to news articles

### 👥 User Management

The system provides administrative tools for managing registered users.

Administrators can:

* View users
* Create users
* Edit users
* Delete users
* Manage user roles

### 💬 Comments

Authenticated users can leave comments on news articles and participate in discussions.

### ⭐ Article Ratings

Users can provide ratings for articles using a numerical rating system.

### 📊 Activity Logging

The application records user activities and provides administrators with an activity log for monitoring system usage.

### 🔑 Authentication

The system provides authentication functionality for registered users and administrators.

---

## 📸 Project Gallery

The following screenshots demonstrate the different interfaces and features of Out-Box-Media.

> Replace the image paths below with your actual screenshots.

### 🌐 Public Interface

#### Guest News List

The main news page available to visitors.

![Guest News List](screenshots/guest-news-list.png)

---

#### Article Detail

The full article page where visitors can read published news.

![Article Detail](screenshots/article-detail.png)

---

### 👤 User Interface

#### User Dashboard

The dashboard available to authenticated users.

![User Dashboard](screenshots/user-dashboard.png)

---

#### Comments & Ratings

Registered users can interact with articles through comments and ratings.

![Comments and Ratings](screenshots/comments-ratings.png)

---

### 🔐 Administrative Interface

#### Admin News Management

Administrators can view and manage published news articles.

![Admin News Management](screenshots/admin-news-management.png)

---

#### Create News

The form used by administrators to create a new article.

![Create News](screenshots/create-news.png)

---

#### Edit News

The interface for modifying existing news articles.

![Edit News](screenshots/edit-news.png)

---

#### Category Management

Administrators can manage news categories.

![Category Management](screenshots/category-management.png)

---

#### Add Category

The form for creating a new news category.

![Add Category](screenshots/add-category.png)

---

#### User Management

The admin interface for viewing and managing registered users.

![User Management](screenshots/user-management.png)

---

#### Add / Edit User

Administrative forms for creating and modifying user accounts.

![User Form](screenshots/user-form.png)

---

#### Activity Logs

The activity log provides an overview of actions performed within the application.

![Activity Logs](screenshots/activity-logs.png)

---

## 📂 Project Structure

A typical Laravel project structure is organized as follows:

```text
Out-Box-Media/
│
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   └── Middleware/
│   └── Models/
│
├── database/
│   ├── migrations/
│   └── seeders/
│
├── public/
│   └── ...
│
├── resources/
│   ├── views/
│   ├── css/
│   └── js/
│
├── routes/
│   └── web.php
│
├── storage/
│   └── ...
│
├── .env.example
├── artisan
├── composer.json
└── README.md
```

---

# 🚀 Local Installation

## Prerequisites

Before running the project, make sure you have the following installed:

* PHP
* Composer
* MySQL
* Laravel-compatible PHP extensions
* XAMPP or another local PHP/MySQL environment

---

## 1. Clone the Repository

Clone the repository:

```bash
git clone <repository-url>
```

Navigate into the project:

```bash
cd Out-Box-Media
```

---

## 2. Install Dependencies

Install the Laravel dependencies:

```bash
composer install
```

---

## 3. Configure Environment

Create a `.env` file from the example:

```bash
cp .env.example .env
```

On Windows, you can also simply copy `.env.example` and rename the copy to:

```text
.env
```

---

## 4. Generate Application Key

Run:

```bash
php artisan key:generate
```

---

## 5. Configure MySQL

Create a MySQL database for the application.

Then update the database configuration in `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=out_box_media
DB_USERNAME=root
DB_PASSWORD=
```

Adjust the username and password according to your local MySQL configuration.

---

## 6. Run Database Migrations

Run the migrations:

```bash
php artisan migrate
```

If the project includes seeders, you can run:

```bash
php artisan migrate --seed
```

---

## 7. Create Storage Link

If the application uses Laravel's public storage system for uploaded images, run:

```bash
php artisan storage:link
```

---

## 8. Start the Laravel Server

Run:

```bash
php artisan serve
```

The application should then be available at:

```text
http://127.0.0.1:8000
```

---

# 🧪 Development Notes

This project was developed primarily for **learning and academic purposes**.

It demonstrates several important concepts in Laravel development, including:

* MVC architecture
* CRUD operations
* Eloquent ORM
* Database relationships
* Authentication
* Authorization
* Role-based access
* Form handling
* File uploads
* Blade templating
* Database migrations
* Seeders
* Activity logging

---

# 🔮 Future Improvements

Potential improvements for the project include:

* Deploy the application to a production environment
* Improve the responsive design
* Add article search functionality
* Add pagination
* Add richer article editing capabilities
* Improve image management
* Add email notifications
* Add more detailed analytics for administrators
* Implement stronger authentication and authorization
* Improve activity log filtering
* Add automated testing

---

# 📌 Project Status

**Local Development / Educational Project**

The current version is functional as a local Laravel application but has not been deployed publicly.

The project serves as a demonstration of building a **role-based news management system using Laravel and MySQL**.

---

## 👨‍💻 Author

**Muhammad Rizky**

Computer Science Student
Universitas Mercu Buana

---

## 📚 Project Focus

**Laravel · PHP · MySQL · MVC · CRUD · Authentication · Role-Based Access Control · Eloquent ORM · Blade**
