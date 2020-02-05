# Phone Book RESTful API Service

![logo](https://cdn.dribbble.com/users/892648/screenshots/6795161/phonebook_1x.jpg)

## Description
Realize such RESTful API

| Verb   | Path                    | Comment                     |
| ------ | ----------------------- | ----------------------------|
| POST   | api/v1/register         | Register user and get token |
| POST   | api/v1/contacts         | Create contact              |
| GET    | api/v1/contacts         | Get all                     |
| GET    | api/v1/contacts/2/10    | Get using pagination 11-20  |
| GET    | api/v1/contact/12       | Get by id=12                |
| GET    | api/v1/contacts/{query} | Get by query                |
| PUT    | api/v1/contacts/12      | Update contact by id=12     |
| DELETE | api/v1/contacts/12      | Delete contact by id=12     |
| GET    | api/v1/countries        | Get countries               |
| GET    | api/v1/timezones        | Get timezones               |

## Stack:
![](https://img.shields.io/badge/-Laravel_6.13.1-brightgreen.png)
![](https://img.shields.io/badge/-Vagrant-green.png)
![](https://img.shields.io/badge/-PHP_7.2-red.png)
![](https://img.shields.io/badge/-PHPUnit-blue.png)
![](https://img.shields.io/badge/-Nginx-important.png)
![](https://img.shields.io/badge/-MySQL-blueviolet.png)
![](https://img.shields.io/badge/-Redis-yellow.png)
![](https://img.shields.io/badge/-Guzzle-black.png)


## Requirements
1. VirtualBox
2. Vagrant

## Installation

```
$ cd 'your_projects_directory'
$ git clone https://github.com/gruzintsev/phonebook.git gruzintsev_phonebook
$ cd gruzintsev_phonebook
$ composer install
$ vagrant up
$ vagrant ssh
$ cd code
$ vendor/bin/phpunit
```

## Test result

![](http://joxi.ru/EA4zPylFoNnNzm.jpg)

## Usage
Add this line to /etc/hosts
```192.168.10.10 phonebook.loc```

1. #### Register user and copy token for the next requests
    ![screen shot](http://joxi.ru/52az7PwFE3e0JA.jpg)
2. #### Create contact
    ![screen shot](http://joxi.ru/Y2LYJPwu7JqvKA.jpg)
    ![screen shot](http://joxi.ru/l2ZROPwSzWLVK2.jpg)
3. #### Get all contacts
    ![screen shot](http://joxi.ru/eAOYQPwu9jDE4m.jpg)
4. #### Get 1 contact by page 2
    ![screen shot](http://joxi.ru/4Ako4KWfoEl1kA.jpg)
5. #### Get contact by id=1
    ![screen shot](http://joxi.ru/nAyx4NyhgMbG92.jpg)
6. #### Get contacts by query=vlad
    ![screen shot](http://joxi.ru/Dr8y5JqIoWvnnm.jpg)
   #### Get contacts by query=asdf
    ![screen shot](http://joxi.ru/ZrJYlPwuwzDeDA.jpg)
7. #### Update contact by id=2
    ![screen shot](http://joxi.ru/J2bV8Pwh0O5YR2.jpg)
8. #### Delete contact by id=1
    ![screen shot](http://joxi.ru/V2VLZPwFdJqV4r.jpg)

## Contact
[gruzintsev@gmail.com](mailto:gruzintsev@gmail.com)

Copyright 2020 Gruzintsev Vladimir