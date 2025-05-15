# Task Manager

# Laravel version 
-> Laravel version used for this project is 12.14.1

# Setup Instructions
1. Clone the repository
-> git clone [Project URL]
-> cd task_manager

2. Install Dependencies
-> composer install
-> npm install && npm run dev

3. Copy & Configure Environment
-> cp .env.example .env
-> php artisan key:generate

4. Run Migrations
-> php artisan migrate

5. Start the Development Server
-> php artisan serve


# App Structures & Features

# Structure 
-> app/Models - Eloquent ORM (Task, User)
-> app/Http/Controllers - Handles Http requests (TaskController)
-> app/Http/Requests - For validation (TaskStoreRequest, TaskUpdateRequest)
-> resources/views - Blade Templates (index.blade.php, create.blade.php, edit.blade.php)
-> routes/web.php - Web routes for the application

# Key Features

-> User authentication with Laravel Breeze
-> CRUD tasks
-> Tasks status management: Pending, In Progress, Completed
-> Task Priority: Low, Medium, High
-> Filter tasks by status, due date, or, priority
-> search tasks by title or description
-> Intuitive UI using Bootstrap

