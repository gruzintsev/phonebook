# Phone Book RESTful API Service

![logo](https://cdn.dribbble.com/users/892648/screenshots/6795161/phonebook_1x.jpg)

## Description
Realize such RESTful API

| Verb   | Path                      | Comment                     |
| ------ | ------------------------- | ----------------------------|
| POST   | api/register              | Register user and get token |
| POST   | contacts                  | Create contact              |
| GET    | contacts                  | Get all                     |
| GET    | contacts/2/10             | Get using pagination 11-20  |
| GET    | contact/12                | Get by id=12                |
| GET    | contacts/{query}          | Get by query                |
| PUT    | contacts/12               | Update contact by id=12     |
| DELETE | contacts/12               | Delete contact by id=12     |
| GET    | countries                 | Get countries               |
| GET    | timezones                 | Get timezones               |

## Stack:
![](https://img.shields.io/badge/-Laravel_6.13.1-brightgreen.png)
![](https://img.shields.io/badge/-Vagrant-green.png)
![](https://img.shields.io/badge/-PHP_7.2-red.png)
![](https://img.shields.io/badge/-PHPUnit-blue.png)
![](https://img.shields.io/badge/-Nginx-important.png)
![](https://img.shields.io/badge/-MySQL-blueviolet.png)


## Requirements
1. VirtualBox
2. Vagrant

## Installation

```
$ cd 'your_projects_directory'
$ git clone https://gruzintsev@bitbucket.org/gruzintsev/phonebook.git gruzintsev_phonebook
$ cd gruzintsev_phonebook
$ composer install
$ vagrant up
$ vagrant ssh
$ cd code
$ vendor/bin/phpunit
```

## Usage
Add this line to /etc/hosts
```192.168.10.10 phonebook.loc```

1. #### Register user and copy token for the next requests
    ![screen shot](http://joxi.ru/l2ZROPwSzWL8q2.jpg)
2. #### Create contact
    ![screen shot](http://joxi.ru/a2XZRBwSw5gyRr.jpg)
    ![screen shot](http://joxi.ru/eAOYQPwu9jD4Lm.jpg)
3. #### Get all contacts
    ![screen shot](http://joxi.ru/5mdYJPDu3V0vx2.jpg)
4. #### Get 1 contact by page 2
    ![screen shot](http://joxi.ru/Q2KYNPwuLJq49r.jpg)
5. #### Get contact by id=2
    ![screen shot](http://joxi.ru/52az7PwFE3e4EA.jpg)
6. #### Get contacts by query=vlad
    ![screen shot](http://joxi.ru/823xPlyh9j3J8A.jpg)
   #### Get contacts by query=asdf
    ![screen shot](http://joxi.ru/Drlo4ZdfVOZpMA.jpg)
7. #### Update contact by id=2
    ![screen shot](http://joxi.ru/8AnoeRKfzGWjNr.jpg)
8. #### Delete contact by id=1
    ![screen shot](http://joxi.ru/KAxo481fZXbMq2.jpg)

## Contact
[gruzintsev@gmail.com](mailto:gruzintsev@gmail.com)

Copyright 2020 Gruzintsev Vladimir