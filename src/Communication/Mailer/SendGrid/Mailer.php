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
 * @package App\Mailer
 */
class Mailer
{
    /**
     * SendGrid api key.
     */
    private const SENDGRID_API_KEY = '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';

    /**
     * SendGrid `from` sender.
     */
    private const SENDGRID_FROM = 'yenjim1986@gmail.com';

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
        $email->setFrom(self::SENDGRID_FROM, $fromName);
        $email->setSubject($subject);
        $email->addContent("text/html", $content);

        foreach ($to as $destination) {
            $email->addTo($destination);
        }

        $sendGrid = new SendGrid(self::SENDGRID_API_KEY);

        try {
            $response = MailerResponse::fromSendGridResponse($sendGrid->send($email));

            return $response->isSuccess();

        } catch (Exception $e) {
            throw new MailerException('Failed to send email to ');
        }
    }

}