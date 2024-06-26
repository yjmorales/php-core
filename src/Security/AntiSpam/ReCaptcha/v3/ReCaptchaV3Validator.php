<?php
/**
 * @author Yenier Jimenez <yjmorales86@gmail.com>
 */

namespace Common\Security\AntiSpam\ReCaptcha\v3;

use Common\DataManagement\Validator\DataValidator;
use Common\Security\AntiSpam\ReCaptcha\v3\ClientToken\IClientTokenRetriever;
use Common\Security\AntiSpam\ReCaptcha\v3\Exception\ReCaptchaV3Exception;
use Illuminate\Support\Arr;
use Exception;

/**
 * This class is responsible to validate a form submission by verifying whether it's submitted by a real user or a
 * robot. It's done by using Google Recaptcha V3 service.
 *
 * @link: https://developers.google.com/recaptcha/docs/v3
 */
class ReCaptchaV3Validator
{
    /**
     * ReCaptcha V3 Secret key.
     *
     * @link: https://www.google.com/recaptcha/admin/create
     *
     * @var string
     */
    private $_secretKey;

    /**
     * @link: https://developers.google.com/recaptcha/docs/verify#api_request
     *
     * @var string
     */
    private $_googleUrlTokenValidator = 'https://www.google.com/recaptcha/api/siteverify';

    /**
     * Used to extract the client token generated by the client action.
     *
     * @var IClientTokenRetriever
     */
    private $_tokenExtractor;

    /**
     * ReCaptchaV3Validator constructor.
     *
     * @param string                $secretKey
     * @param IClientTokenRetriever $tokenExtractor
     */
    public function __construct(
        string $secretKey,
        IClientTokenRetriever $tokenExtractor
    ) {
        $this->_secretKey               = $secretKey;
        $this->_tokenExtractor          = $tokenExtractor;
    }


    /**
     * Validates if the request is performed by as real user or not.
     *
     * @param string $userAction Holds the action name performed by client and supposed to be validated.     *
     *
     * @return bool True if is valid, means the action is performed by real user. Otherwise false, means it is a robot.
     *
     * @throws ReCaptchaV3Exception
     * @link       https://developers.google.com/recaptcha/docs/verify#api-response
     *
     * @deprecated Use validateByUserAction instead.
     */
    public function validate(string $userAction): bool
    {
        return $this->validateByUserAction($userAction);
    }

    /**
     * Validates if the request is performed by as real user or not.
     *
     * @link https://developers.google.com/recaptcha/docs/verify#api-response
     *
     * @param string|null $userAction Holds the action name performed by client and supposed to be validated.
     *
     * @return bool True if is valid, means the action is performed by real user. Otherwise false, means it is a robot.
     *
     * @throws ReCaptchaV3Exception
     */
    public function validateByUserAction(string $userAction = null): bool
    {
        try {
            $clientToken = $this->_tokenExtractor->getToken();
            $response    = file_get_contents("{$this->_googleUrlTokenValidator}?secret={$this->_secretKey}&response={$clientToken}");
            $data        = json_decode($response, true);
            $success     = Arr::get($data, 'success', false);
            $score       = Arr::get($data, 'score', 0);
            $action      = Arr::get($data, 'action');

            $isValid = true;

            $isValid &= (bool)$success;
            $isValid &= $score >= 0.5;
            $isValid &= null !== $action;

            return (bool)$isValid;
        } catch (Exception $e) {
            throw new ReCaptchaV3Exception('Unable to verify if the re-captcha v3 token is valid or not.', 0, $e);
        }
    }

    /**
     * Validates that a token is valid or not. The token must be submitted via POST
     *
     * @return bool
     * @throws ReCaptchaV3Exception
     */
    public function validateToken(): bool
    {
        $url   = $this->_googleUrlTokenValidator;
        $token = $_POST['g-recaptcha-response'];
        $valid = (new DataValidator())->isValidString($token);
        if (!$valid) {
            throw new ReCaptchaV3Exception('Unable to verify if the re-captcha v3 token is valid or not. The token was not sent via POST');
        }

        try {
            $data    = ['secret' => $this->_secretKey, 'response' => $token, 'remoteip' => $_SERVER['REMOTE_ADDR']];
            $options = [
                'http' => [
                    'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                    'method'  => 'POST',
                    'content' => http_build_query($data)
                ]
            ];
            $context = stream_context_create($options);
            $result  = file_get_contents($url, false, $context);

            return (bool)json_decode($result)->success;
        } catch (Exception $e) {
            throw new ReCaptchaV3Exception('Unable to verify if the re-captcha v3 token is valid or not.', 0, $e);
        }
    }
}