"lit_blog" is a web application that allows users to create blog posts and view both their own content and posts created by others.

This project is developed using the Django web framework. Its main goal is to provide a clean and user-friendly interface for managing blog content efficiently.

## Technologies Used

* Backend: Django (Python)
* Frontend: HTML, CSS, JavaScript
* Database: SQLite

## Project Structure

blog/
├── blog_app/          -> Handles blog-related logic and data
├── config/            -> Django project settings
├── statics/           -> Static files (CSS, images)
├── templates/         -> HTML template files
├── db.sqlite3         -> SQLite database file
├── manage.py          -> Django management script
└── .env               -> Environment variables

### Note on venv field:

Instead of installing Django globally, I chose to install it in a virtual environment to keep dependencies isolated and better managed.

## Features

* Display a list of blog posts
* Create new blog posts
* Modal dialog on the post creation page
* Simple and readable interface
* Custom design using plain CSS

## Future Development Plans

* User login and registration system
* Commenting and like features
* Tag and category system
* Search and filtering capabilities
  
**This project was developed for personal learning and educational purposes.**
