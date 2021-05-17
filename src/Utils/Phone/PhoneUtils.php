<?php
/**
 * @author Yenier Jimenez <yjmorales86@gmail.com>
 */

namespace Common\Utils\Phone;

use Exception;

/**
 * Class PhoneUtility
 *
 * @package Common\Utils\Phone
 */
class PhoneUtility
{
    private const SUPPORTED_COUNTRY_CODES = ['us'];

    /**
     * Function to sanitize the phone number by convert it into a plain text and removing all extra characters.
     *
     * @param string $phone
     *
     * @return string
     */
    public static function plain(string $phone): string
    {
        return str_replace(['-', ' ', '(', ')', '+'], '', $phone);
    }

    /**
     * Function to sanitize the phone number and convert it into the format xxx-xxx-xxxx
     *
     * @param string      $phone
     * @param string|null $countryCode
     *
     * @return string
     *
     * @throws Exception
     */
    public static function dashed(string $phone, string $countryCode = 'us'): string
    {
        // Sanitizing phone and country code.
        self::_sanity($phone, $countryCode);

        // Formatting
        switch ($countryCode) {
            case 'us':
                return self::toDashedUS($phone);
                break;
        }

        return $phone;
    }

    /**
     * Function to sanitize the phone number and convert it into the format x (xxx) xxx-xxxx
     *
     * @param string      $phone
     * @param string|null $countryCode
     *
     * @return string
     *
     * @throws Exception
     */
    public static function semiDashed(string $phone, string $countryCode = 'us'): string
    {
        // Sanitizing phone and country code.
        self::_sanity($phone, $countryCode);

        // Formatting
        switch ($countryCode) {
            case 'us':
                return self::toSemiDashedUS($phone);
                break;
        }

        return $phone;
    }

    /**
     * Helper function to convert a US phone into the format xxx-xxx-xxxx
     *
     * @param string $phone
     *
     * @return string
     *
     * @throws Exception
     */
    private static function toDashedUS(string $phone): string
    {
        $phoneSize    = mb_strlen($phone);
        $allowedSizes = [10, 11];

        if (!in_array($phoneSize, $allowedSizes)) {
            throw new Exception("The phone: {$phone} hasn't a valid length to be US phone number.");
        }

        switch ($phoneSize) {
            case 10:
                $phone = substr_replace($phone, '-', 3, 0);
                $phone = substr_replace($phone, '-', 7, 0);
                break;
            case 11:
                $phone = substr_replace($phone, '-', 1, 0);
                $phone = substr_replace($phone, '-', 5, 0);
                $phone = substr_replace($phone, '-', 9, 0);
                break;
        }

        return $phone;
    }

    /**
     * Helper function to convert a US phone into the format (xxx) xxx-xxxx
     *
     * @param string $phone
     *
     * @return string
     *
     * @throws Exception
     */
    private static function toSemiDashedUS(string $phone): string
    {
        $phoneSize    = mb_strlen($phone);
        $allowedSizes = [10, 11];

        if (!in_array($phoneSize, $allowedSizes)) {
            return $phone;
        }

        switch ($phoneSize) {
            case 10:
                $phone = substr_replace($phone, '(', 0, 0);
                $phone = substr_replace($phone, ')', 4, 0);
                $phone = substr_replace($phone, ' ', 5, 0);
                $phone = substr_replace($phone, '-', 9, 0);
                break;
            case 11:
                $phone = substr_replace($phone, ' ', 1, 0);
                $phone = substr_replace($phone, '(', 2, 0);
                $phone = substr_replace($phone, ')', 6, 0);
                $phone = substr_replace($phone, ' ', 7, 0);
                $phone = substr_replace($phone, '-', 11, 0);
                $phone = "+{$phone}";
                break;
        }

        return $phone;
    }

    /**
     * @param string $phone
     * @param string $countryCode
     *
     * @return void
     *
     * @throws Exception
     */
    private static function _sanity(string &$phone, string &$countryCode): void
    {
        $phone = self::plain($phone);

        $phoneSize    = mb_strlen($phone);
        $allowedSizes = [10, 11];

        if (!in_array($phoneSize, $allowedSizes)) {
            throw new Exception("The phone: {$phone} hasn't a valid length to be US phone number.");
        }

        // Sanitizing country code
        $countryCode = strtolower($countryCode);
        if (!in_array($countryCode, self::SUPPORTED_COUNTRY_CODES)) {
            throw new Exception("The given country code: {$countryCode} is not supported.");
        }
    }
}