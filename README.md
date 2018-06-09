# phlexa-expressive-skeleton

Skeleton application to build voice applications for Amazon Alexa with 
phlexa, PHP and Zend\Expressive. 

## Dependencies

* PHP 7
* [phlexa](https://github.com/phoice/phlexa)
* [phlexa for Zend\Expressiv](https://github.com/phoice/phlexa-expressive)
* [Zend\Expressive micro-framework](https://docs.zendframework.com/zend-expressive/)

This skeleton application is built with `Zend\Expressive`. For further 
details about the `Zend\Expressive` micro-framework please refer to the 
official [docs](https://docs.zendframework.com/zend-expressive/).

## Installation

Create a new project based on the skeleton application simply with Composer:

```
composer create-project phoice/phlexa-expressive-skeleton name-of-your-project
```

## What you get

* A `Zend\Expressive` application setup for you to handle requests from 
  Amazon Alexa and to send your responses back to Alexa. The application is 
  based on the [phlexa Library](https://github.com/phoice/phlexa)
* An Alexa application based on phlexa with a simple `HelloIntent` to
  send some messages back to the user. It even contains a privacy page 
  ready to use.
* A text helper for the Alexa Application to handle messages and titles 
  for your skill.
* Signature validation is already built-in.
* Request logging is also setup for you.

## Little tutorial

1. Create an account at the Amazon Developer Portal: 
   https://developer.amazon.com/de/
2. Switch to the Alexa section and choose the Alexa Skills Kit.
   https://developer.amazon.com/edw/home.html#/skills
3. Add a new skill.
4. In the Skill information:
   * Choose the "Custom Interaction Model" and a Language
   * Enter a name for your skill "Hello World" and an invocation name "hello world"
   * Save
5. On the Interaction model:
   * Launch the Skill Builder
   * Add an Intent with the Name "HelloIntent"
   * Add "hello world" as a sample utterance and press enter
   * Save the model
   * Build the model
6. Proceed to the configuration:
   * Select the HTTPS endpoint and pick a geographical region
   * Now copy the URL of your server (see below) as the endpoint URL.
   * Save
7. Proceed to the SSL Certificate:
   * Choose the appropriate option.
   * Save
8. Proceed to the Test:
   * Now you can test your new skill.
9. Fill in the Publishing Information and Privacy & Compliance section when you finished 
   developing and testing the skill.
   
For further details please refer to the 
[docs](https://developer.amazon.com/public/solutions/alexa/alexa-skills-kit/getting-started-guide).

## Setup your server

To get your skill running with PHP you need to setup your server which 
supports PHP 7. Install the application and setup a SSL Certificate. For 
further details please refer to the 
[docs](https://developer.amazon.com/public/solutions/alexa/alexa-skills-kit/docs/registering-and-managing-alexa-skills-in-the-developer-portal#h2_ssl).

If you have setup your server you can test the `Hello` example skill with 
the following URL: https://your.server.com/hello/

Just sent a POST request (for example with Postman) with these headers:
                                                         
```
Content-Type: application/json
signaturecertchainurl : https://s3.amazonaws.com/echo.api/echo-api-cert-4.pem
signature: B/bxAdkIabkzsScfUsSfkz7pJrNLc1eoOOLk8qwG1ZudQRv7KcvyNa/91g74Zg3cRpifXEco4669MaZb4Cqs+vZ9TaTfftAMzy/Pc79AMuf1dU6GfUU7tp6cuavfqTD8cWlYN5TjEMCJbS1Y+VU929mX0edOZcZin7db6bOoZHu5gU8OSQ2r+6UMk88z5uuSjPyt9Du9vaC3Ics/Br30fEIplIgCt4y/UGRK76Rqo4L/DuNjty3o2mcU8bICK5xfZwCeH7b5UFwdjngtp8VfhKPtosZmCuWvMn+y9HoS06ll9cdI1FPLN9w7KwMZFY8UzTc+0GfAwntxzlowAwkPhQ==
```
                                                         
To simulate the launch of the skill use this body:

```
{
  "session": {
    "sessionId": "SessionId.test",
    "application": {
      "applicationId": "amzn1.ask.skill.place-your-skill-id-here"
    },
    "attributes": {},
    "user": {
      "userId": "amzn1.ask.account.test"
    },
    "new": true
  },
  "request": {
    "type": "LaunchRequest",
    "requestId": "EdwRequestId.test",
    "locale": "de-DE",
    "timestamp": "2017-01-26T20:38:55Z"
  },
  "version": "1.0"
}
```

And to test the `HelloIntent` use this body:

```
{
  "session": {
    "sessionId": "SessionId.test",
    "application": {
      "applicationId": "amzn1.ask.skill.place-your-skill-id-here"
    },
    "attributes": {},
    "user": {
      "userId": "amzn1.ask.account.test"
    },
    "new": true
  },
  "request": {
    "type": "IntentRequest",
    "requestId": "EdwRequestId.test",
    "locale": "de-DE",
    "timestamp": "2017-01-27T20:29:59Z",
    "intent": {
      "name": "HelloIntent",
      "slots": {}
    }
  },
  "version": "1.0"
}
```

## Configuration

Have a closer look at these configuration files for activating the signature 
validation and the request logging feature.

* `/config/autoload/phlexa.config.global.php`
* `/config/autoload/phlexa.config.development.php`


## Develop on Docker

There is a docker file wish you can use for your local development. Your local code will also mount into the docker contaner. 
To access the server type into the browser "http:://localhost"

* install docker (see: https://docs.docker.com/install/)
* start "docker-compose up -d"
* install vendor packages "docker exec phlexa-expressive-skeleton_php-apache_1 composer install"
* open in browser "http://localhost"

Hint: There also a maria db server included in this docker files. You can find the user and the password in file "./mariadb/Dockerfile" The maria db is not necessary to run the skeleton app.
If you don't want to create the maria db modify the dockerfile.