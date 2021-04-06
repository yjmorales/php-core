<?php
/**
 * @author Yenier Jimenez <yjmorales86@gmail.com>
 */

namespace Common\Security\AntiSpam\ReCaptcha\v3\ClientToken;

use Common\Security\AntiSpam\ReCaptcha\v3\ClientToken\Exception\ClientTokenNotFoundException;

/**
 * Class responsible for retrieving the re-captcha v3 client token from http POST.
 *
 * @link: https://developers.google.com/recaptcha/docs/verify
 */
class HttpPostTokenRetriever implements IClientTokenRetriever
{
    /**
     * @inheritdoc
     */
    public function getToken(): string
    {
        $clientToken = $_POST['g-recaptcha-response'] ?? false;

        if (!$clientToken) {
            throw new ClientTokenNotFoundException('The parameter `g-recaptcha-response` is not present within POS request.');
        }

        return $clientToken;
    }
}