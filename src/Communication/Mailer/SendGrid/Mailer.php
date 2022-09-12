<?php
/**
 * @author Yenier Jimenez <yjmorales86@gmail.com>
 */

namespace Common\Communication\Mailer\SendGrid;

use SendGrid\Mail\Mail;
use SendGrid;
use Exception;
use SendGrid\Mail\To;

/**
 * An implementation of a Send Grid Email Sender.
 * If this class is being used within a symfony project then it's good to define a service like this:
 *

  Common\Communication\Mailer\SendGrid\Mailer:
    class: Common\Communication\Mailer\SendGrid\Mailer
    arguments:
      - '%env(SENDGRID_API_KEY)%'
      - '%personal_page_sender_email%'
      - '%personal_page_sender_name%'

 * @package Common\Communication\Mailer\SendGrid
 */
class Mailer
{
    /**
     * SendGrid API KEY for sender of Personal Page Sender .
     *
     * @var string
     */
    protected $_sendGridApiKey;

    /**
     * Holds the sender email tied to the SendGrid account.
     *
     * @var string
     */
    protected $_senderEmail;

    /**
     * Holds the sender name tied to the SendGrid Account.
     *
     * @var string
     */
    protected $_senderName;

    /**
     * @param string $sendGridApiKey SendGrid API KEY for sender of Personal Page Sender .
     * @param string $senderEmail    Holds the sender email tied to the SendGrid account.
     * @param string $senderName     Holds the sender name tied to the SendGrid Account.
     */
    public function __construct(string $sendGridApiKey, string $senderEmail, string $senderName)
    {
        $this->_sendGridApiKey = $sendGridApiKey;
        $this->_senderEmail    = $senderEmail;
        $this->_senderName     = $senderName;
    }

    /**
     * Sends an email.
     *
     * @param string $subject Email subject
     * @param string $content Holds the email html content value.
     * @param To     ...$to   Holds the destination emails.
     *
     * @return bool True if the message has been sent, otherwise false.
     */
    public function send(string $subject, string $content, To ...$to): bool
    {
        $result = true;
        try {
            $email = new Mail();
            $email->setFrom($this->_senderEmail, $this->_senderName);
            $email->setSubject($subject);
            $email->addTos($to);
            $email->addContent('text/html', $content);
            $sendgrid = new SendGrid($this->_sendGridApiKey);
            $sendgrid->send($email);
        } catch (Exception $e) {
            $result = false;
        }

        return $result;
    }
}