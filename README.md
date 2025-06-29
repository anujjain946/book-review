# 📚 Book Review – A Laravel Learning Project

A simple Laravel project for learning by doing!  
Users can register, browse books, and add reviews & ratings.  
Admin can manage books. Great for practicing core Laravel concepts in a practical way.

---

## 🚀 Project Features  
✅ CRUD for Books (Admin only)  
✅ Users can add Reviews & Ratings  
✅ See average rating & all reviews for each book  
✅ Auth middleware protection  
✅ Eloquent relationships  
✅ Blade templates with layouts  
✅ Flash messages for success/errors

✏️ Learning Highlights
Routing & Controllers

Blade Templating

Eloquent ORM & Relationships

Authentication with Laravel Breeze

Validation & Policies

File Uploads

Flash messages

Git & GitHub best practices

📖 Why This Project?
The Book Review app is built for reverse learning — instead of only reading theory, you build, test, break, and improve your Laravel skills by working on a real project.



---

## ⚙️ Requirements
- PHP >= 8.1
- Composer
- Node.js & npm
- MySQL or SQLite

---

## 🗂️ Project Setup

```bash
# 1️⃣ Clone the project
git clone https://github.com/anujjain946/book-review.git

# 2️⃣ Go into the project directory
cd book-review

# 3️⃣ Install PHP dependencies
composer install

# 4️⃣ Install JS dependencies
npm install && npm run dev

# 5️⃣ Copy .env and generate app key
cp .env.example .env
php artisan key:generate

# 6️⃣ Set up your database in .env

# 7️⃣ Run migrations and seeders
php artisan migrate --seed

# 8️⃣ Start the server
php artisan serve

Visit http://localhost:8000 to see your project!

