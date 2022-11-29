<?php
/**
 * @author Yenier Jimenez <yjmorales86@gmail.com>
 */

namespace Common\Communication\HtmlMailer;

/**
 * Contains a message holding the info to create an email.
 */
class MailerMessage
{
    /**
     * Holds the email addresses that will receive the email.
     *
     * @var string[]|null
     */
    private array $_to = [];

    /**
     * A boolean indicator of whether the email is internal or not.
     *
     * @var bool
     */
    private bool $_isInternal = false;

    /**
     * Holds the sender email address.
     *
     * @var string
     */
    private string $_from;

    /**
     * Holds the email addresses being part of the contact copy.
     *
     * @var string[]
     */
    private array $_cc = [];

    /**
     * Holds the email message.
     *
     * @var string|null
     */
    private ?string $_message = null;

    /**
     * Holds the email subject.
     *
     * @var string|null
     */
    private ?string $_subject;

    /**
     * Holds the attachment to be sent within the email.
     *
     * @var EmailAttachment[]
     */
    private array $_attachments = [];

    /**
     * Holds the context information used to render the email content. (html).
     *
     * @var array
     */
    private array $_context = [];

    /**
     * Holds the template filename used to generate(render) the email content.
     *
     * @var string|null
     */
    private ?string $_htmlTemplate = null;

    /**
     * ArtcMailerMessage constructor.
     *
     * @param string|null $subject
     * @param string|null ...$to
     */
    public function __construct(?string $subject, ?string ...$to)
    {
        $this->_subject = $subject;
        $this->_to      = $to;
    }

    /**
     * Adds an attachment.
     *
     * @param EmailAttachment $attachment
     */
    public function addAttachment(EmailAttachment $attachment): void
    {
        $this->_attachments[] = $attachment;
    }

    /**
     * @return array
     */
    public function getTo(): array
    {
        return $this->_to;
    }

    /**
     * @param array $to
     */
    public function setTo(array $to): void
    {
        $this->_to = $to;
    }

    /**
     * @return bool
     */
    public function isInternal(): bool
    {
        return $this->_isInternal;
    }

    /**
     * @param bool $isInternal
     */
    public function setIsInternal(bool $isInternal): void
    {
        $this->_isInternal = $isInternal;
    }

    /**
     * @return string
     */
    public function getFrom(): string
    {
        return $this->_from;
    }

    /**
     * @param string $from
     */
    public function setFrom(string $from): void
    {
        $this->_from = $from;
    }

    /**
     * @return array
     */
    public function getCc(): array
    {
        return $this->_cc;
    }

    /**
     * @param array $cc
     */
    public function setCc(array $cc): void
    {
        $this->_cc = $cc;
    }

    /**
     * @return string|null
     */
    public function getMessage(): ?string
    {
        return $this->_message;
    }

    /**
     * @param string|null $message
     */
    public function setMessage(?string $message): void
    {
        $this->_message = $message;
    }

    /**
     * @return string|null
     */
    public function getSubject(): ?string
    {
        return $this->_subject;
    }

    /**
     * @param string|null $subject
     */
    public function setSubject(?string $subject): void
    {
        $this->_subject = $subject;
    }

    /**
     * @return array
     */
    public function getAttachments(): array
    {
        return $this->_attachments;
    }

    /**
     * @param array $attachments
     */
    public function setAttachments(array $attachments): void
    {
        $this->_attachments = $attachments;
    }

    /**
     * @return array
     */
    public function getContext(): array
    {
        return $this->_context;
    }

    /**
     * @param array $context
     */
    public function setContext(array $context): void
    {
        $this->_context = $context;
    }

    /**
     * @return string|null
     */
    public function getHtmlTemplate(): ?string
    {
        return $this->_htmlTemplate;
    }

    /**
     * @param string|null $htmlTemplate
     */
    public function setHtmlTemplate(?string $htmlTemplate): void
    {
        $this->_htmlTemplate = $htmlTemplate;
    }
}