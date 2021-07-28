# Order-management-system
This is web application which allow you manage your customer orders.

## Technologies
* Bootstrap 5
* PHP 8
* HTML 5
* CSS
* JavaScript

## Requirements
* PHP server e.g. [XAMPP](https://www.apachefriends.org)
* MS SQL Server 

## Setup
1. Dowload [the Microsoft Drivers for PHP for SQL Server](https://docs.microsoft.com/en-us/sql/connect/php/overview-of-the-php-sql-driver)
2. Run dowloaded program and as location to place extracted files type path to you ` php/ext ` folder
3. Open your php.ini file and press ` CTR + F ` and search ` extension=curl `
4. In this place add extension to ` php_pdo_sqlsrv_ts ` and ` php_sqlsrv_ts ` file for your PHP version and server achitecture

Example for PHP version 8 and architecture x64
```
extension=php_pdo_sqlsrv_80_ts_x64
extension=php_sqlsrv_80_ts_x64
```
    
6. Restart your PHP server
7. Clone this respositiory or dowload respository in ZIP and place in your PHP server

## Usage
1. Open respository as site using your PHP server
2. Open settings and create new database.  Enter:

```
MS SQL Server name
New database name
MS SQL Server login
MS SQL Server password
Login to new application user
Password to new application user
Repeat password
```

3. Log in to apllication
