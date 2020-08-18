![Imgur](https://i.imgur.com/2pyx56g.gif)



# Login API using JWT authorization



## Description

> This is a login API buult on REST protocol. It can create, read user information and, validate login information entered from the client side. For validation the API uses JSON Web Tokens.



---

## Table of Contents (Optional)




- [Features](#features)
- [Build](#build)
- [Usage](#usage)
-  - [Deployment](#deployment)
-  - [Devlopment](#development)
- [Version Control](#version)
- [Team](#team)
- [Acknowledgement](#acknowledgement)
- [License](#license)



---

## Features

**Objective**

A simple REST API, with the following endpoints:-
1. Signup - /signup
2. Login - /login
3. Profile page - /profile

Signup and Login will be the public routes(ie they would not require any authentication token), and the profile page will be a private route(ie it will require correct authentication token (ex - JWT) which was provided on login)


***Signup***

User can register themself by providing their basic info(name, email, password etc)

Request body structure
![Imgur](https://i.imgur.com/L0WnzB6.jpg)

In response a message will be returned about the status of the creation.
![Imgur](https://i.imgur.com/AwcrkO5.jpg)

***Login***

User can log in to the system by providing email  and password (a token will be returned if authenticated)

Request Body structure
![Imgur](https://i.imgur.com/0rKWNWy.jpg)


Expected Response
![Imgur](https://i.imgur.com/64Z3X0Y.jpg)

***Profile Page****

Users can access their info from this page.

Request param - JWT Token in Header

Response - should return all the user’s info.
![Imgur](https://i.imgur.com/67H6u3A.jpg)

---

## Build
### Languages
- PHP

- MySQL as its database for storing users info

Bonus Points

### Architecture
- OOPS Concept is used
- REST architecture


---

## Usage

### Deployment

coming up soon! with endpoints. For now functionality can be tested on postman using the .php extenstions.

### Development
Want to contribute? Great!

To fix a bug or enhance an existing module, follow these steps:

- Fork the repo
- Create a new branch (`git checkout -b improve-feature`)
- Make the appropriate changes in the files
- Add changes to reflect the changes made
- Commit your changes (`git commit -am 'Improve feature'`)
- Push to the branch (`git push origin improve-feature`)
- Create a Pull Request

### Bug / Feature Request

If you find a bug (the application couldn't handle the query and / or gave undesired results), kindly open an issue [here]((https://github.com/mondar88/student-management-system/issues/new) by including your search query and the expected result.

If you'd like to request a new function, feel free to do so by opening an issue [here](https://github.com/mondar88/student-management-system/issues/new). Please include sample queries and their corresponding results.

---

## Version Control
## To-Do
- consume API
- deployment
- addtional tables for info


---

## Team

> Developer

| <a href="#" target="_blank">**Mondar**</a> |
| :---: |
| <img src="https://i.imgur.com/ztwrGnn.png" align="left" height="auto" width="148" > |
| <a href="http://github.com/fvcproductions" target="_blank">`github.com/mondar88`</a> |


---



## Acknowledgement

Youtube Channel Traversy Media [PHP REST API From Scratch](https://www.youtube.com/watch?v=-nq4UbD0NT8)

Youtube Channel Technical Suneja  [PHP REST API From Scratch with Postman](https://www.youtube.com/watch?v=jqoDmy_iqpg&t=558s)

Youtube Channel learnWebCoding  [REST API Development](https://www.youtube.com/watch?v=aSpKAj8GRtk&t=1070s)
