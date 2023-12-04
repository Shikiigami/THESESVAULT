<p align="center"><a href="" target="_blank"><img src="https://psuthesesvault.online/img/tvlogo.png" width="400" alt="ThesesVault Logo"></a></p>

<p align="center">
<a href="https://github.com/ImLiXun17/CapstoneProject.git"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
</p>

## About ThesesVault

ThesesVault is  a Web-based application that is dedicated to providing an effective and centralized system to store and view, organized and track theses, research projects and the liks, all done and concluded by the students of Palawan State University. 

## ThesesVault Installation

Step 1: You need to download the following application below, to download them just click highlighted text. <br>
1. [Xampp](https://www.apachefriends.org/download.html)
2. [VS Code](https://code.visualstudio.com/download)
3. [Git](https://git-scm.com/downloads)
3. Intallation: Run the installer and follow the on-screen instructions. Ensure Apache and MySQL are installed and started in Xampp.

## Laravel Project Setup

#### **1. Clone our project in GitHub** 
```
git clone (https://github.com/ImLiXun17/CapstoneProject.git)
```

#### **2. Install Composer**

1. Direct to [Composer's website](https://getcomposer.org/) and follow the instructions for your operating system.

#### **3. Install Laravel Dependencies**

Once Composer is installed, navigate to your project directory in the terminal/command prompt and run composer install to install Laravel's dependencies.

```
composer install
```
Ensure you have Node.js and npm installed. Navigate to your project directory in the terminal and run

```
npm install
```
This command installs all the necessary dependencies mentioned in the package.json file.

## Setting Up Visual Studio Code

#### **1. Open Project in VS Code**

Open VS Code and use File -> Open Folder to select our Laravel project folder clone from Github.



VS Code has extensions that can enhance the Laravel development experience. For Laravel, they might consider installing extensions like "Laravel Extension Pack" or "Laravel Snippets".

## Running the Project

#### **1. Database Setup**
Import the database file in our project to your MySQL phpmyadmin within your xampp control pannel

#### **2. Start XAMPP**
Start Apache and MySQL through the XAMPP control panel.

#### **3. Run Laravel Server**
Create 2 terminal in the terminal within VS Code, navigate to your project directory and run php artisan serve and in the other terminal run npm run dev to start the Laravel development server.

```
php artisan serve
```
```
npm run dev
```
#### **4. Access the Project**
Open a web browser and visit http://localhost:8000 (or another port if specified by the php artisan serve command) to access the Laravel project.
