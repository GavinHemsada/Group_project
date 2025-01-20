Eye Clinic Management System

Project Overview

The Eye Clinic Management System is a comprehensive solution designed to streamline the operations of an eye clinic. This university group project, developed by a team of three members, provides an efficient way for patients, doctors, staff, and administrators to interact with the system. The project integrates a payment gateway (PayPal), mail gateway (SMTP), and utilizes HTML, PHP, JavaScript, and Bootstrap 5 to provide a responsive and user-friendly interface. The system is divided into front-end and back-end modules to ensure scalability and maintainability.

Features

General Features:

Responsive design using Bootstrap 5.

Secure integration with PayPal for online payments.

Email notifications and reminders via SMTP.

Stakeholders:

Patients

Schedule and manage appointments.

View prescriptions and medical records.

Make online payments for consultations and services.

Doctors

Manage patient appointments.

Access and update medical records.

Generate prescriptions and reports.

Staff

Manage clinic operations and schedules.

Handle patient queries and assist with appointments.

Administrator

Oversee all system operations.

Manage user roles and permissions.

Generate and view detailed reports and analytics.

Technology Stack

Front-End:

HTML

Bootstrap 5

JavaScript

Back-End:

PHP

MySQL (Database)

Integrations:

Payment Gateway: PayPal

Mail Gateway: SMTP

System Architecture

The system is divided into two main parts:

Front-End:

Provides an intuitive interface for users.

Ensures mobile and desktop compatibility through responsive design.

Back-End:

Handles data storage and retrieval using PHP and MySQL.

Manages user authentication and authorization.

Implements business logic and integrates external services.

Installation Instructions

Prerequisites:

PHP 8.0 or higher

MySQL 5.7 or higher

A web server (e.g., Apache or Nginx)

Composer for dependency management

Steps:

Clone the repository to your local machine.

git clone <repository-url>

Navigate to the project directory.

cd eye-clinic-management-system

Set up the database:

Import the provided SQL file into your MySQL database.

Configure environment settings:

Update the config.php file with database credentials and API keys for PayPal and SMTP.

Install dependencies:

composer install

Start the web server and access the system through your browser.

Team Members

Member 1: Responsible for front-end design and implementation.

Member 2: Responsible for front-end design and implementation.

Member 3: Developed the back-end functionality, database integration, Managed payment gateway and email gateway integrations.

Usage

Access the login page based on your role (Patient, Doctor, Staff, or Admin).

Use the respective dashboard to access the features specific to your role.

Patients can schedule appointments and make payments securely via PayPal.

Doctors can view and update patient records and appointments.

Staff members can manage clinic schedules and operations.

Administrators can monitor system performance and generate reports.
