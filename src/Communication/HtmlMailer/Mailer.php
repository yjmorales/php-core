<?php
/**
 * @author Yenier Jimenez <yjmorales86@gmail.com>
 */

namespace Common\Communication\HtmlMailer;

use Monolog\Logger;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mime\Address;
use Exception;

/**
 * This class is responsible to send an email. What this mailer implementation adds is that
 * allows to insert images within the html content.
 *
 * This class MUST be defined as a service within the file `config/services.yaml`.
 *
 *     App\Core\Comunication\Email\Mailer:
 *          class: App\Core\Comunication\Email\Mailer
 *          arguments: ['@mailer', 'sender_email@sample.com', 'admin@internal.com', 'Sender Name']
 *
 *     Also, must be defined the logger service as follows:
 *     logger:
 *          alias: 'monolog.logger'
 *          public: true
 *
 */
class Mailer
{
    /**
     * Mime email sender. Symfony mailer.
     *
     * @var MailerInterface
     */
    protected MailerInterface $_mailer;

    /**
     * Holds the logger instance to log messages.
     *
     * @var Logger
     */
    private Logger $_logger;

    /**
     * Holds the sender email.
     *
     * @var string
     */
    private string $_from;

    /**
     * Holds the internal email contact used to send internal emails.
     *
     * @var string
     */
    private string $_internalTo;

    /**
     * Holds the sender name tied to the SendGrid Account.
     *
     * @var string
     */
    protected string $_senderName;

    /**
     * @param MailerInterface $mailer
     * @param string          $from
     * @param string          $internalTo
     * @param string          $senderName
     */
    public function __construct(
        MailerInterface $mailer,
        Logger $logger,
        string $from,
        string $internalTo,
        string $senderName
    ) {
        $this->_mailer     = $mailer;
        $this->_logger     = $logger;
        $this->_from       = $from;
        $this->_internalTo = $internalTo;
        $this->_senderName = $senderName;
    }

    /**
     * Sends an email.
     *
     * @param MailerMessage $message Instance holding the message data.
     *
     * @return bool
     */
    public function send(MailerMessage $message): bool
    {
        $email = new TemplatedEmail();
        $email
            ->from(new Address($this->_from, $this->_senderName))
            ->subject($message->getSubject())
            ->to(...$message->getTo())
            ->htmlTemplate($message->getHtmlTemplate())
            ->context($message->getContext());

        if ($message->isInternal()) {
            $email->to($this->_internalTo);
        }

        $response = true;
        try {
            $this->_mailer->send($email);
        } catch (Exception|TransportExceptionInterface $e) {
            $this->_logger->error('There was an error sending an email.' , [
                'trace' => $e->getTraceAsString(),
                'cause' => $e->getMessage(),
            ]);
            $response = false;
        }

        return $response;
    }
}