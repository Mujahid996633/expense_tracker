# Simple Expense Tracker (PHP + MySQL)

A basic web-based Expense Tracker built using **PHP** and **MySQL**.

## Features
- Add a new expense (title, amount, category, date)
- List all expenses
- Delete an expense

## Requirements
- PHP 7+
- MySQL Server
- A local server stack (XAMPP, WAMP, or similar)

## Setup

1. Create the database and table using `schema.sql`:

```bash
mysql -u root -p < schema.sql
```

2. Copy the project folder to your web root, e.g.:
   - `C:/xampp/htdocs/expense_tracker` on Windows (XAMPP)

3. Update `db.php` if your MySQL credentials are different.

4. Start Apache and MySQL, then open in browser:

```
http://localhost/expense_tracker/index.php
```

## Usage
Use the form on the page to add expenses. The table below shows all expenses with an option to delete.
