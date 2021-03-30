<?php
/**
 * @author Yenier Jimenez <yjmorales86@gmail.com>
 */

namespace App\Communication\Mailer\SendGrid;

/**
 * Holds an email message structure.
 *
 * @package App\Mailer\SendGrid
 */
class EmailMessage
{
    /**
     * @var string
     */
    protected $_to;

    /**
     * @var string
     */
    protected $_subject;

    /**
     * @var string
     */
    protected $_content;

    /**
     * @return string
     */
    public function getTo(): string
    {
        return $this->_to;
    }

    /**
     * @param string $to
     */
    public function setTo(string $to): void
    {
        $this->_to = $to;
    }

    /**
     * @return string
     */
    public function getSubject(): string
    {
        return $this->_subject;
    }

    /**
     * @param string $subject
     */
    public function setSubject(string $subject): void
    {
        $this->_subject = $subject;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->_content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->_content = $content;
    }
}