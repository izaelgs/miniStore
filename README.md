# MiniStore

## Screenshots

![home](https://user-images.githubusercontent.com/72363296/208973988-17286985-2f33-40ce-8e01-92e1132fb744.PNG)

![register](https://user-images.githubusercontent.com/72363296/208974003-79bae9c8-5079-43b8-ba65-522e183e29ab.PNG)

![login](https://user-images.githubusercontent.com/72363296/208974015-a2f9e652-4f44-4471-b362-25ceb3158eaf.PNG)

![home_logged](https://user-images.githubusercontent.com/72363296/208974043-b638f815-d881-42c3-919b-59968098acfe.PNG)

![Product](https://user-images.githubusercontent.com/72363296/208974222-4c9e1c49-f107-4e9b-bc17-9ce3ac291daa.PNG)

![cart](https://user-images.githubusercontent.com/72363296/208974245-e83e2087-cb65-4f52-b34e-c26268c79385.PNG)

![address](https://user-images.githubusercontent.com/72363296/208974274-618d0f6c-b854-4740-bea7-ab4c66b00653.PNG)

![payment](https://user-images.githubusercontent.com/72363296/208974294-280e5d49-e960-44d2-86ae-66840203a018.PNG)

![orderCompleted](https://user-images.githubusercontent.com/72363296/208974316-ad66bc43-bd54-4eb3-b19c-8397e10ba88f.PNG)


## Technologies used

### Frontend
- VueJs^3
- VueRouter
- VueX
- Iconify
- JsCookie
- Jquery
- Bootstrap
- Sass

### Backend
- PHp
- Laravel
- Jwt-Auth
- MySql
___

## Prerequisites
- Php 7.4
- Composer
- MySql
- NodeJs
___

## How to use?

## Step 1
The first step is to download the project, for this you can copy the code below and run it in your GIT terminal

```
git clone git@github.com:izaelgs/miniStore.git
```
____

## Step 2
### BACKEND
#### Step 1
With PHP and Composer installed, lets install laravel dependencies with the commands
```
composer install
cp .env.example .env
php artisan key:generate
```
#### Step 2
Then is needed to configure some database things on .env file
```
sudo nano .env
```

Then is possible to build the database structure running
```
php artisan migrate --seed
```

#### Step 3
Aubsequently let's generate a key for jwt
```
php artisan jwt:secret
```

### FRONTEND
Afterwords with NodeJs installed, just run the commands and then laravelmix will display some instructions
```
npm install
npm run dev
```

## Step 2
Now, just use the comand to run the server on localhost:8000
```
php artisan serve
```
