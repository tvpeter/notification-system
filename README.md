# NOTIFICATION SYSTEM

This is a HTTP notification system that has endpoints and channels. When a message is published on a particular channel, 
all the subscribing servers instantly receive the message.

## Architecture

The notification system is built using Laravel and Redis.


## Set Up

-   Setup Redis on your system (Guide for Mac Users)[https://phoenixnap.com/kb/install-redis-on-mac]
-   Run the command `redis-server -v` to know the installed version
-   You can interact with Redis shell by running the command `redis-cli`
-   The default port for Redis is 6379
-   Clone this repo into your system
-   Navigate to the root directory and run `composer install` to install all packages
-   Rename the `.env.example` file to `.env`
-   Set the following parameters in the `.env` file:
   ``-   REDIS_CLIENT=predis
    -   REDIS_HOST=127.0.0.1 (if local host address)
    -   REDIS_PASSWORD=null (if any)
    -   REDIS_PORT=6379``



## Testing the Notification system

-   On the same root directory, run `php artisan serve` to start the publisher server 
-   Open Postman client
-   Send requests to this endpoint `http://localhost:{PORT}/api/publish/{topic}`with the following payload details
    ``
            POST /api/publish/update HTTP/1.1
            Host: localhost:{PORT}
            Content-Type: application/json

            {
                "topic": {topic},
                "message": "body of the message"
            }
    ``
-   Open another terminal window `command T` for mac
-   In the same root directory, start another server `php artisan serve` which will utilize another another
-   run this curl command to subscribe to the above channel `curl --location --request POST 'http://localhost:{second server port}/api/subscribe/{topic}'`
-   Run this command to interact with the redis shell `redis-cli -p {PORT DEFAULT=6378}` OR `redis-cli` 
-   Run thee command `MONITOR` to get subscribed messages
-   Re-publish on the channel using Postman to view the messages on the redis shell
-   You can add as many subscriber servers as you want, and publish messages

Thank you.