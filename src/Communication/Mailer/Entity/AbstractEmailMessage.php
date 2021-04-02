<?php
/**
 * @author Yenier Jimenez <yjmorales86@gmail.com>
 */

namespace Common\Communication\Mailer\SendGrid;

use Illuminate\Support\Arr;
use JsonSerializable;

/**
 * Holds an email message structure abstraction.
 *
 * @package Common\Communication\Mailer\SendGrid
 */
abstract class AbstractEmailMessage implements JsonSerializable
{
    /**
     * @var string[]
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
     * @var string
     */
    protected $_fromName;

    /**
     * @return string[]
     */
    public function getTo(): array
    {
        return $this->_to;
    }

    /**
     * @param string[] $to
     */
    public function setTo(array $to): void
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

    /**
     * @return string
     */
    public function getFromName(): string
    {
        return $this->_fromName;
    }

    /**
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
     * @param array $data
     *
     * @return void
     */
    public function fromArray(array $data): void
    {
        $this->_to = Arr::get($data, 'to', []);
        $this->_to = Arr::get($data, 'subject', '');
        $this->_to = Arr::get($data, 'content', '');
        $this->_to = Arr::get($data, 'from_name', '');
    }
}