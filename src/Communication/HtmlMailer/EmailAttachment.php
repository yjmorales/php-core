<?php
/**
 * @author Yenier Jimenez <yjmorales86@gmail.com>
 */

namespace Common\Communication\HtmlMailer;

/**
 * Contains an abstraction for an attachment to be sent.
 */
class EmailAttachment
{
    /**
     * The file path
     *
     * @var string|null
     */
    protected ?string $_path = null;

    /**
     * The file name
     *
     * @var string|null
     */
    protected ?string $_name;

    /**
     * Gets the path of file.
     *
     * @return string|null
     */
    public function getPath(): ?string
    {
        return $this->_path;
    }

    /**
     * Changes the file path.
     *
     * @param string|null $path New value
     */
    public function setPath(?string $path): void
    {
        $this->_path = $path;
    }

    /**
     * Gets the file name.
     *
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->_name;
    }

    /**
     * Sets the file name.
     *
     * @param string|null $name New value.
     */
    public function setName(?string $name): void
    {
        $this->_name = $name;
    }
}