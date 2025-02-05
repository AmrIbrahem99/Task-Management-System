

# Task Management System
## Overview
This project is a Task Management System built with Laravel, to help users manage tasks, 
 and team collaboration. The application allows for creating, updating, and tracking tasks, 
user authentication and access control. It uses Docker for easy setup and deployment.

 
## Features
- **Task creation and management**
- **User authentication and authorization**
- **Assigning a task to the user**
- **Task can depend on other task (subtasks)**
- **Docker-based deployment**

## Prerequisites
- **PHP(if you are not going to use docker)**
- **MySQL(if you are not going to use docker)**
- **Composer**
- **Docker**
- **Docker Compose**
- **Git**


## Installation
1. Clone the repository
```bash
git clone

git clone https://github.com/yourusername/task-management-system.git
cd task-management-system
```
2. Build Docker Containers 

Make sure Docker and Docker Compose are installed on your system. Run the following command to build the containers:**
```bash
docker-compose up --build -d
```
This will build and start the following containers:
- **app**: Laravel application container
- **mysql**: MySQL database container
- **nginx**: Nginx web server container

3. Run Migrations and Seed Database

```bash
docker-compose exec app php artisan migrate --seed
```
4. Import Postman Collection

 In the root directory of the project, you will find a folder named `postman_collection` which contains a postman collection that you can import to test the API endpoints.

5. Access the Application


After you import the postman collection , go to environment and make sure  base url id `http://localhost:80/api` 

-***Want to have a look at database diagram ?  it's located at `database/database_design`***


## Usage
- **Register a new user**
- **Login with the registered user**
- **Create a new task**
- **Assign the task to a user**
- **Mark the task as completed**
- **Create subtasks for a task**
- **View all tasks**
- **View single task**
- **Enable or disable users**
- **Logout**
