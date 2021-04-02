<?php
/**
 * @author Yenier Jimenez <yjmorales86@gmail.com>
 */

namespace Common\Communication\Mailer\SendGrid;

use Common\Communication\Mailer\SendGrid\Exception\MailerException;
use SendGrid\Mail\Mail;
use SendGrid;
use Exception;
use SendGrid\Mail\TypeException;

/**
 * An implementation of a Send Grid Email Sender.
 *
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
     * Sender Email Address.
     *
     * @var string
     */
    protected $_sendGridFromEmailAddress;

    /**
     * Mailer constructor.
     *
     * @param string $sendGridApiKey
     * @param string $sendGridFromEmailAddress
     */
    public function __construct(string $sendGridApiKey, string $sendGridFromEmailAddress)
    {
        $this->_sendGridApiKey           = $sendGridApiKey;
        $this->_sendGridFromEmailAddress = $sendGridFromEmailAddress;
    }

    /**
     * @param string $subject  Email subject
     * @param string $content  Email content (html format).
     * @param string $fromName The sender name that should be shown on the destination inbox.
     * @param string ...$to    List of email address that will receive the message.
     *
     * @return bool
     *
     * @throws MailerException
     * @throws TypeException
     */
    public function send(string $subject, string $content, string $fromName, string ...$to): bool
    {
        $email = new Mail();
        $email->setFrom($this->_sendGridFromEmailAddress, $fromName);
        $email->setSubject($subject);
        $email->addContent("text/html", $content);

        foreach ($to as $destination) {
            $email->addTo($destination);
        }

        $sendGrid = new SendGrid($this->_sendGridApiKey);

        try {
            $response = MailerResponse::fromSendGridResponse($sendGrid->send($email));

            return $response->isSuccess();

        } catch (Exception $e) {
            throw new MailerException('Failed to send email to ');
        }
    }
}