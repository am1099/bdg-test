# Intro

This technical test is designed so that you can do as little or as much as you want. It's a chance to demonstrate your knowledge of: PHP, MySQL, HTML, CSS, Javascript.

# Deliverables

## Task one

Without the assistance of a PHP Framework (Third PHP party libraries are allowed as well as HTML/CSS/JS frameworks). Build a system that can insert and fetch a list of users from a mysql database.

(Database schema and Seed data provided)

## Task two

Somewhere on the index page, list the last 5 addresses that belong to the user 'Steve'

## Task three

Email project files to `cv@bdgroup.co.uk` along with your first and last name

# Expectations

1. Build a HTML form that enables the user to create a user record

2. Handle the form submission and insert the user record into the database

3. List all the user records in the database on the index page

# Considerations

## Application Logic

- Validation
- Security
- Error handling

## Database Interaction

- PDO
- MySQLi

# Installation

We have provided a docker-compose file however use whatever development environment you feel comfortable with (WAMP, Vagrant, Local LAMP).

You will be require:

- Web server (Apache or Nginx)
- PHP >= 7.2
- MySQL / MariaDB

In this project there is a 'docker-compose' file that will build a development environment for this task.

1. Install docker for desktop https://www.docker.com/products/docker-desktop
   1a) Ensure Docker Engine/Docker for Desktop is running

2. Using the command line change to the root directory of this project
   2a. Run `docker-compose build`
   2b. Run `docker-compose up` (mysql can take a min to boot up fully)

3. In your web browser go to `127.0.0.1` this will display the index page of the application

4. You can connect to MySQL database using the following details (refer to the docker-compose.yml)
   - hostname: bdg-mysql (for docker set up)
   - ip: 127.0.0.1 (for alternate set up)
   - database: bdg-tech-test
   - username: root
   - password: secret
   - port: 3306
