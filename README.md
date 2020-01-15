# inout
Open Source Attendance System: In and Out with Notification

# Installation

1. Clone this repo

    ```bash
    git clone https://github.com/valluminarias/inout.git 
    ```
2. Cd to the directory

    ```bash
    cd ./inout 
    ```
3. Install the backend dependencies

    ```bash 
    composer install 
    ```  
4. Setup the database and credentials in the `.env` file and run the migration

    ```bash 
    php artisan migrate --seed 
    ```
5. Compile the frontend assets

    ```bash 
    yarn install && yarn prod 
    ```
6. You can now access the site with your preferred url setup. e.g. [ http://inout.test ]

TODO

- [ ] Authorization (Role, Permission).
- [ ] Page for Manager where they can view attendance of all user
- [ ] Dashboard
- [ ] Send Notification to FB Messenger
