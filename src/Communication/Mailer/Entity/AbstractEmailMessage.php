<?php
/**
 * @author Yenier Jimenez <yjmorales86@gmail.com>
 */

namespace Common\Communication\Mailer\Entity;

use Illuminate\Support\Arr;
use JsonSerializable;

/**
 * Holds an email message structure abstraction.
 *
 * @package Common\Communication\Mailer\Entity
 */
abstract class AbstractEmailMessage implements JsonSerializable
{
    /**
     * Holds a destination list. All values should be email addresses.
     *
     * @var string[]
     */
    protected $_to;

    /**
     * Holds the email subject.
     *
     * @var string
     */
    protected $_subject;

    /**
     * Holds the email content. Html or plain text.
     *
     * @var string
     */
    protected $_content;

    /**
     * Holds the sender name.
     *
     * @var string
     */
    protected $_fromName;

    /**
     * Returns the destination list.
     *
     * @return string[]
     */
    public function getTo(): array
    {
        return $this->_to;
    }

    /**
     * Sets the local destination list.
     *
     * @param string[] $to
     */
    public function setTo(array $to): void
    {
        $this->_to = $to;
    }

    /**
     * Returns the email subject.
     *
     * @return string
     */
    public function getSubject(): string
    {
        return $this->_subject;
    }

    /**
     * Sets the email subject.
     *
     * @param string $subject
     */
    public function setSubject(string $subject): void
    {
        $this->_subject = $subject;
    }

    /**
     * Returns the email content.
     *
     * @return string
     */
    public function getContent(): string
    {
        return $this->_content;
    }

    /**
     * Sets the email content.
     *
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->_content = $content;
    }

    /**
     *
     * Returns the sender name.
     *
     * @return string
     */
    public function getFromName(): string
    {
        return $this->_fromName;
    }

    /**
     * Sets the sender name.
     *
     * @param string $fromName
     */
    public function setFromName(string $fromName): void
    {
        $this->_fromName = $fromName;
    }

    /**
     * Exports the class data into a json
     */
    public function jsonSerialize()
    {
        return [
            'to'        => $this->_to,
            'subject'   => $this->_subject,
            'content'   => $this->_content,
            'from_name' => $this->_fromName,
        ];
    }

    /**
     * By using a given array this method populates the class properties with the respective array values.
     *
     * @param array $data Array holding the resource data.
     *
     * @return void
     */
    public function fromArray(array $data): void
    {
        $this->_to       = Arr::get($data, 'to', []);
        $this->_subject  = Arr::get($data, 'subject', '');
        $this->_content  = Arr::get($data, 'content', '');
        $this->_fromName = Arr::get($data, 'from_name', '');
    }
}