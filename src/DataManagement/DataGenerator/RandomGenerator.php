<?php
/**
 * @author Yenier Jimenez <yjmorales86@gmail.com>
 */

namespace Common\DataManagement\DataGenerator;

use DateTime;
use Exception;

/**
 * Class responsible to generate utils random data used to populate a database or other resources that needs initial
 * data to operate.
 */
class RandomGenerator
{
    /**
     * Generates an username
     *
     * @return string
     */
    public static function generateUsername(): string
    {
        // Returns a specific char between a-z
        $letter   = chr(rand(97, 122));
        $lastName = self::generateLastName();

        return strtolower($letter . $lastName);
    }

    /**
     * Generates a email address.
     *
     * @return string
     */
    public static function generateEmail(): string
    {
        $username    = self::generateUsername();
        $emailServer = self::generateEmailServerName();
        $domain      = self::generateDomain();

        return "$username@$emailServer.$domain";
    }

    /**
     * Generates a ser of emails address.
     *
     * @param int $limit Numbers of emails to generate.
     *
     * @return string[]
     */
    public static function generateEmails(int $limit = 20): array
    {
        $result  = [];
        $names   = SeedValues::getNames();
        $domains = SeedValues::getEmailDomains();
        for ($i = 0; $i < $limit; $i++) {
            $name      = $names[array_rand($names)];
            $domain    = $domains[array_rand($domains)];
            $result [] = strtolower($name) . rand(1, 2019) . '@' . $domain;
        }

        return $result;
    }

    /**
     * Generates a set of phones numbers.
     *
     * @param int $limit Numbers of phones to generate.
     *
     * @return string[]
     */
    public static function generatePhonesNumbers(int $limit = 20): array
    {
        $result      = [];
        $phonesCodes = SeedValues::getPhonesCodes();
        for ($i = 0; $i < $limit; $i++) {
            $code      = $phonesCodes[array_rand($phonesCodes)];
            $result [] = '(' . $code . ') ' . rand(0, 9) . rand(0, 9) . rand(0, 9) . ' ' . rand(0, 9) . rand(0,
                    9) . rand(0, 9);
        }

        return $result;
    }

    /**
     * Generate a set of names.
     *
     * @param int $limit
     *
     * @return string[]
     */
    public static function generateFullNames(int $limit = 20): array
    {
        $names     = SeedValues::getNames();
        $lastNames = SeedValues::getLastnames();
        $result    = [];
        for ($i = 0; $i < $limit; $i++) {
            $name      = $names[array_rand($names)];
            $lastName  = $lastNames[array_rand($lastNames)];
            $result [] = "$name $lastName";
        }

        return $result;
    }

    /**
     * Generate a set of address.
     *
     * @param int $limit
     *
     * @return string[]
     */
    public static function generateAddresses(int $limit = 20): array
    {
        $result  = [];
        $typesSt = SeedValues::getTypeSt();
        $sts     = SeedValues::getStNames();
        $cities  = SeedValues::getCities();
        $states  = SeedValues::getStates();

        for ($i = 0; $i < $limit; $i++) {
            $typeSt    = $typesSt[array_rand($typesSt)];
            $st        = $sts[array_rand($sts)];
            $city      = $cities[array_rand($cities)];
            $state     = $states[array_rand($states)];
            $result [] = rand(1, 9999) . " $st $typeSt, $city, $state, " . rand(10000, 99999);
        }

        return $result;
    }

    /**
     * Generate an address.
     *
     * @return string
     */
    public static function generateAddress(): string
    {
        $typesSt = SeedValues::getTypeSt();
        $sts     = SeedValues::getStNames();
        $cities  = SeedValues::getCities();
        $states  = SeedValues::getStates();
        $typeSt  = $typesSt[array_rand($typesSt)];
        $st      = $sts[array_rand($sts)];
        $city    = $cities[array_rand($cities)];
        $state   = $states[array_rand($states)];

        return rand(1, 9999) . " $st $typeSt, $city, $state, " . rand(10000, 99999);
    }

    /**
     * Generates a city name.
     *
     * @return string
     */
    public static function generateCity(): string
    {
        return $cities[array_rand(SeedValues::getCities())];
    }

    /**
     * Generates a state code.
     *
     * @return string
     */
    public static function generateStateCode(): string
    {
        return $cities[array_rand(SeedValues::getStates())];
    }

    /**
     * Generates a zip code
     *
     * @return string
     */
    public static function generateStateZipCode(): string
    {
        return (string)rand(10000, 99999);
    }

    /**
     * Generates a gender
     *
     * @return string
     */
    public static function generateGender(): string
    {
        $result = 'F';
        $gender = rand(1, 2);
        if (1 === $gender) {
            $result = 'M';
        }

        return $result;
    }

    /**
     * Generates a valid datetime
     *
     * @return DateTime
     *
     * @throws Exception
     */
    public static function generateDate(): DateTime
    {
        $month = rand(1, 12);
        $year  = rand(1900, date('Y'));
        $day   = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $date  = new DateTime();
        $date->setDate($year, $month, $day);

        return $date;
    }

    /**
     * Generate a last name
     *
     * @return string
     */
    public static function generateLastName(): string
    {
        $lastNames = SeedValues::getLastnames();
        $index     = rand(0, count($lastNames) - 1);

        return $lastNames[$index];
    }

    /**
     * Generate a name.
     *
     * @return string
     */
    public static function generateName(): string
    {
        $names = SeedValues::getNames();
        $index = rand(0, count($names) - 1);

        return $names[$index];
    }

    /**
     * Generates an email server name.
     *
     * @return string
     */
    public static function generateEmailServerName(): string
    {
        $names = SeedValues::getEmailServerNames();
        $index = rand(0, count($names) - 1);

        return $names[$index];
    }

    /**
     * Generate a domain
     *
     * @return string
     */
    public static function generateDomain(): string
    {
        $domain = SeedValues::getDomains();
        $index  = rand(0, count($domain) - 1);

        return $domain[$index];
    }

    /**
     * Generate a password set.
     *
     * @param int $size Size of the password
     *
     * @return string
     */
    public static function generatePassword(int $size = 10): string
    {
        $az           = range('a', 'z');
        $AZ           = range('A', 'Z');
        $numbers      = range(0, 9);
        $specialChars = SeedValues::getSpecialChars();
        $source       = array_merge($az, $AZ, $numbers, $specialChars);

        $password = '';
        for ($i = 0; $i < $size; $i++) {
            $password .= $source[rand(0, count($source) - 1)];
        }

        return $password;
    }

    /**
     * Generate a set of alphanumerics chars.
     *
     * @param int $size
     *
     * @return string
     */
    public static function generateKey(int $size = 32): string
    {
        $az      = range('a', 'z');
        $AZ      = range('A', 'Z');
        $numbers = range(0, 9);

        $source = array_merge($az, $AZ, $numbers);
        $key    = '';
        for ($i = 0; $i < $size; $i++) {
            $key .= (string)$source[rand(0, count($source) - 1)];
        }

        return $key;
    }

    /**
     * Generate a unique id.
     *
     * @param string $prefix
     *
     * @return string
     */
    public static function generateUniqueId(string $prefix = ''): string
    {
        return md5(uniqid($prefix));
    }

    /**
     * Generate an alpha string.
     *
     * @param int $length
     *
     * @return string
     */
    public static function generateAlphaString(int $length = 10): string
    {
        $az = range('a', 'z');

        $string = '';
        for ($i = 0; $i < $length; $i++) {
            $string .= $az[rand(0, count($az) - 1)];
        }

        return $string;
    }
}