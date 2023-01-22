# PHP Core Library

## Author

- Name: Yenier Jimenez
- email: yjmorales86@gmail.com
- website: http://yenierjimenez.com

## About the project

This library is built to be used by PHP Projects. The intention is to implement common 
tasks for many projects like email delivery, Google Recaptcha V3 validations, etc.


Below are described the modules already implemented.

### Content

<br>

->>>> 1) SENDGRID


Holds two modules to manage emails using sendgrid. This module can be reused
by Symfony projects by adding a new service:

#### First Implementation
    Common\Communication\Mailer\SendGrid\Mailer:
        class: Common\Communication\Mailer\SendGrid\Mailer
            arguments:
            - '%env(SENDGRID_API_KEY)%'
            - '%personal_page_sender_email%'
            - '%personal_page_sender_name%'
    
 - For security reasons the sendgrid api key is held by an environmental variable `env(SENDGRID_API_KEY)`
 - The parameters `personal_page_sender_email` and `personal_page_sender_name` should be defined also by the application.


#### Second Implementation (used to send rich html as email body).
    App\Core\Comunication\Email\Mailer:
        class: App\Core\Comunication\Email\Mailer
        arguments: ['@mailer', 'sender_email@sample.com', 'admin@internal.com', 'Sender Name']


<br>
<br>
->>>> 2) AUTO-PHONE-FORMAT (jQuery)

Holds a js helper to convert a text field value into phone format (###)###-####.

<br>
<br>
->>>> 3) ANTI-SPAMMING

Supports anti-spamming by using [Google ReCaptchaV3](https://developers.google.com/recaptcha/docs/v3)
<br>
<br>
<br>
->>>> 4) Phone number utilities and Twig Extension for phone formatting.

Holds some utils class and functions to manipulate phone formats and to render phone in twig templates.
<br>
<br>
->>>> 5) Random Data Generator

Holds some components to generate random data like: names, lastnames, cities, etc.  
<br>
<br>
->>>> 6) Pheanstalkd implementation

Holds an implementation for Pheanstalkd.

