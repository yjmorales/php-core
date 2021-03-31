<?php
/**
 * @author Yenier Jimenez <yjmorales86@gmail.com>
 */

namespace Common\Communication\Mailer\SendGrid;

use SendGrid\Response as SendGridResponse;

/**
 * Represents the Mailer Response.
 *
 * @package Common\Communication\Mailer\SendGrid
 */
class MailerResponse
{
    /**
     * Status codes representing a success repsonse.
     */
    private const SUCCESS_STATUS_CODES = [200, 202];

    /**
     * @var bool
     */
    protected $_isSuccess = false;

    /**
     * MailerResponse constructor.
     *
     * @param int $statusCode SendGrid Response status code.
     */
    public function __construct(int $statusCode)
    {
        $this->_isSuccess = in_array($statusCode, self::SUCCESS_STATUS_CODES);
    }

    /**
     * @return bool
     */
    public function isSuccess(): bool
    {
        return $this->_isSuccess;
    }

    /**
     * Generate a new Mailer Response from the response returned by SendGrid.
     *
     * @param SendGridResponse $sendGridResponse Holds the response returned by SendGrid.
     *
     * @return MailerResponse
     */
    public static function fromSendGridResponse(SendGridResponse $sendGridResponse): MailerResponse
    {
        $response = new self($sendGridResponse->statusCode());

        return $response;
    }
}