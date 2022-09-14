# PHP Core Library

### Author

- Name: Yenier Jimenez
- email: yjmorales86@gmail,com
- website: http://yenierjimenez.com

### About the project

This library is built to be used by PHP Projects

### Version

0.1

### Content

1. SENDGRID

Holds a module to manage email using sendgrid. This module can be reused
by Symfony projects by adding a new service:

    Common\Communication\Mailer\SendGrid\Mailer:
        class: Common\Communication\Mailer\SendGrid\Mailer
            arguments:
            - '%env(SENDGRID_API_KEY)%'
            - '%personal_page_sender_email%'
            - '%personal_page_sender_name%'

2. auto-phone-format (JS)

Holds a helper to convert a text field value into the phone format (###)###-####.
It requires jquery to be added.

3. ANTI-SPAMING

Supports anti-spamming by using [Google ReCaptchaV3](https://developers.google.com/recaptcha/docs/v3)

4. Phone number utilities and Twig Extension for phone formatting.



