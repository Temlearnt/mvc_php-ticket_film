# Cinnamon - Simple Ticket Booking System

## 📌 Description
Cinnamon is a simple movie ticket booking application developed using PHP with a Model-View-Controller (MVC) architecture. This application features two types of users: **Admin** and **Customer**. It was created as a group assignment for the third semester but was completed individually.

## 🚀 Key Features
- **Customer**
  - View available movies
  - Book movie tickets
  - Check booking history
  
- **Admin**
  - Manage movie listings (add, edit, delete)
  - Manage user data
  - View booking transactions

## 🛠️ Technologies Used
- **Programming Language**: PHP
- **Architecture**: Model-View-Controller (MVC)
- **Database**: MySQL
- **CSS Framework**: (Optional: Bootstrap, Tailwind, or others if used)

## 📂 Project Structure
```
Cinnamon/
│── app/
│   ├── config/
│   ├── controllers/
│   ├── repositories/
│   ├── services/
│   ├── core/
│   ├── views/
│   │   ├── .htaccess
│   │   ├── autoload.php
│   │   ├── init.php
│── public/
│   ├── assets/
│   │   ├── css/
│   │   ├── img/
│   │   ├── js/
│── vendors/
│   ├── css/
│   ├── img/
│   ├── js/
│   ├── plugin/
│── .htaccess
│── index.php
│── README.md
```

## 🔧 How to Run the Project
1. **Clone this repository**
   ```sh
   git clone https://github.com/Temlearnt/mvc_php-ticket_film.git
   ```
2. **Navigate to the project folder**
   ```sh
   cd cinnamon
   ```
3. **Configure the database**
   - Create a new database in MySQL
   - Import the `.sql` file (if available)
   - Update the database configuration in `config/database.php`

4. **Start a local server** (using XAMPP, MAMP, or PHP built-in server)
   ```sh
   php -S localhost:8000
   ```
5. **Open a browser** and access the application at `http://localhost:8000`

## 📌 Demo Accounts
| Role  | Username | Password |
|--------|------------|------------|
| Admin | admin       | 111111  |
| Customer | customer   | 222222  |

## 📞 Contact
For any questions or feedback regarding this project, feel free to reach out:
- **Email**: [putusutha30@gmail.com](mailto:putusutha30@gmail.com)
- **GitHub**: [Putusutha](https://github.com/Putusutha)

---
**Third-Semester Group Assignment** (Completed Individually) 🎓

