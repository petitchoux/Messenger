# Messenger

## Table of Contents
1. [Overview](#Overview)
1. [User Stories](#User-Stories)
1. [Walkthroughs](#Walkthroughs)

## Overview
### Description
Messenger is a chatting web application that allows users to create an account and log in, search for other users, and send and receive messages. Additionally, the user will be able to change their email, password, profile image, and recover their password with a security question if forgotten. 

### Functionality & Approach
A simple interface will be established for the frontend to allow the user to be able to interact with the application. This will include simple forms where the user will be asked for their information and input to create an account and send messages. PHP and SQL will be used to communicate with the local server and database to get and post information. 

## User Stories 

- [x] User signs up and logs in
- [x] User searches for and selects another user
- [x] User sends and receives messages from other users
- [x] User uploads a profile image
- [x] User can change their email or password
- [x] User can recover their password with a security question

### Flow Navigation (Screen to Screen)

* Login -> Signup (if user does not have an account)
* Signup -> Login
* Login -> Forget Password Recovery
* Chat -> Select a user 
* Chat -> Search for a user
* Chat -> Logout
* Search -> Results
* Results -> Chat
* Search -> Settings
* Settings -> Change email, password, security answer
* Settings -> Upload profile image 

## Walkthroughs

<img src="https://i.imgur.com/U3d2dU4.png" width="700">
User signs up<br/>


<img src="https://i.imgur.com/dJSD9Xl.png">
Messaging directory<br/>


<img src="https://i.imgur.com/fCJgluK.png" width="300">
Search for a user<br/>


<img src="https://i.imgur.com/Tyhp87r.png">
Account settings<br/>


<img src="https://i.imgur.com/y4Kelz5.png" width="300">
Change profile image<br/>


<img src="https://i.imgur.com/bxwYgFz.png">
Change password<br/>


<img src="https://i.imgur.com/nw7J5Et.png" width="300">
Password recovery<br/>


### Databases

<img src="https://i.imgur.com/LmiM8Wy.png" width="700">
Users<br/>


<img src="https://i.imgur.com/SdniUa0.png" width="700">
Messages
