<?php
/**
 * @author Yenier Jimenez <yjmorales86@gmail.com>
 */

namespace Common\Security\AntiSpam\ReCaptcha\v3\ClientToken;

/**
 * Interface that defines the functions to interact with Re-Captcha V3 Client tokens.
 */
interface IClientTokenRetriever
{
    /**
     * Retrieves the generated re-captcha v3 client token.
     *
     * @return string
     */
    public function getToken(): string;
}