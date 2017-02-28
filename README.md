# **Hair Salon**
#### Jason Brown 2/24/2017

&nbsp;
## Description
An app for a hair salon. The owner will be able to add stylists, and for each stylist, add clients who see that stylist. The stylists work independently, so each client only belongs to a single stylist.

&nbsp;
## Database Setup
CREATE DATABASE hair_salon;
USE hair_salon;
CREATE TABLE stylists (id serial PRIMARY KEY, stylist_name VARCHAR (255));

CREATE TABLE clients (id serial PRIMARY KEY, client_name VARCHAR(255), stylist_id INT);
&nbsp;
## Specifications

|Behavior|Input 1|Output|
|--------|-------|------|
| An owner inputs a name of a stylist. | "Jane" | "Jane" |
| An owner inputs another stylist. | "Mary" | " Jane", "Mary" |
| An owner deletes all stylists. | 'delete' | " " |
| An owner adds a stylist and assigns said stylist with a client. | Stylist - "Barbara", Client - "Max" | "Barbara", "Max" |
| An owner deletes a client. | "Max" | " " |
| An owner deletes all clients. | 'delete' | " " |


&nbsp;
## Setup/Installation Requirements
##### _To view and use this application:_
* You will need the dependency manager Composer installed on your computer to use this application. Go to [getcomposer.org] (https://getcomposer.org/) to download Composer for free.
* Go to my [Github repository] (https://github.com/Brendangrubb/animal_shelter)
* Download the zip file via the green button
* Unzip the file and open the **_hair-salon-master_** folder
* Open Terminal, navigate to **_hair-salon-master_** project folder, type **_composer install_** and hit enter
* Navigate Terminal to the **_hair-salon-master/web_** folder and set up a server by typing **_php -S localhost:8000_**
* Type **_localhost:8000_** into your web browser
* The application will load and be ready to use!

&nbsp;
## Known Bugs
* No known bugs

&nbsp;
## Technologies Used
* PHP
* Silex
* SQL
* Apache
* Twig
* PHPUnit
* Composer
* Bootstrap
* CSS
* HTML

&nbsp;
_If you have any questions or comments about this program, you can contact me at [jasontbrown99@gmail.com](mailto:jasontbrown99@gmail.com)._

Copyright (c) 2017 Jason Brown

This software is licensed under the GPL license
