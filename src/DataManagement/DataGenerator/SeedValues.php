<?php
/**
 * @author Yenier Jimenez <yjmorales86@gmail.com>
 */

namespace Common\DataManagement\DataGenerator;

/**
 * Sets of randoms seed values used to generate random values. It's used by RandomGenerator.class
 */
class SeedValues
{
    /**
     * Holds the `administrator` role code.
     */
    const ROLE_ADMIN_CODE = 'ROLE_ADMIN';

    /**
     * Holds the `administrator` role name.
     */
    const ROLE_ADMIN_NAME = 'ADMINISTRATOR';

    /**
     * Holds the `super administrator` role code.
     */
    const ROLE_SUPER_ADMIN_CODE = 'ROLE_SUPER_ADMIN';

    /**
     * Holds the `super administrator` role name.
     */
    const ROLE_SUPER_ADMIN_NAME = 'SUPER ADMINISTRATOR';

    /**
     * Holds the `user` role code.
     */
    const ROLE_USER_CODE = 'ROLE_USER';

    /**
     * Holds the `user` role name.
     */
    const ROLE_USER_NAME = 'USER';

    /**
     * Returns data for Roles
     *
     * @return array
     */
    public static function getRoles(): array
    {
        return [
            ['code' => self::ROLE_SUPER_ADMIN_CODE, 'name' => self::ROLE_SUPER_ADMIN_NAME,],
            ['code' => self::ROLE_ADMIN_CODE, 'name' => self::ROLE_ADMIN_NAME,],
            ['code' => self::ROLE_USER_CODE, 'name' => self::ROLE_USER_NAME,],
            ['code' => 'ROLE_SPECIALIST', 'name' => 'SPECIALIST',],
            ['code' => 'ROLE_VIEWER', 'name' => 'VIEWER',],
            ['code' => 'ROLE_USER', 'name' => 'USER',],
            ['code' => 'ROLE_GUEST', 'name' => 'GUEST',]
        ];
    }

    /**
     * Returns a set of names
     *
     * @return string[]
     */
    public static function getNames(): array
    {
        return [
            'Bethany',
            'Amelia',
            'Olivia',
            'Olivia',
            'Emily',
            'Poppy',
            'Ava',
            'Isabella',
            'Jessica',
            'Lily',
            'Sophie',
            ' Margaret',
            'Samantha',
            'Bethany',
            'Elizabeth',
            'Joanne',
            'Oliver',
            'Jake',
            'Jack',
            'Harry',
            'Jacob',
            'Charlie',
            'George',
            'William',
        ];
    }

    /**
     * Returns a set of last names
     *
     * @return string[]
     */
    public static function getLastnames(): array
    {
        return [
            'Smith',
            'Johnson',
            'Williams',
            'Jones',
            'Davis',
            'Brown',
            'Miller',
            'Cabrera',
            'Perez',
            'Jimenez',
            'Lorenzo',
            'Gonzalez',
            'Wilson',
            'Cabrera',
            'Garcia',
            'Arias',
        ];
    }

    /**
     * Returns a set of phones codes
     *
     * @return string[]
     */
    public static function getPhonesCodes(): array
    {
        return ['305', '303', '786', '720', '214', '813',];
    }

    /**
     * Returns a set of domains.
     *
     * @return string[]
     */
    public static function getEmailDomains(): array
    {
        return ['gmail.com', 'hotmail.com', 'aol.com', 'yahoo.es', 'enterprise.uk', 'nauta.cu',];
    }

    /**
     * Returns set of prefix of street types.
     *
     * @return string[]
     */
    public static function getTypeSt(): array
    {
        return [
            'St.',
            'Street',
            'Ct.',
            'Rd',
            'Dr.',
            'Ave',
            'Pl',
        ];
    }

    /**
     * Returns a set of Street names.
     *
     * @return string[]
     */
    public static function getStNames(): array
    {
        return [
            'Killian',
            'North Miami',
            'Calais',
            'Lincoln',
            'Normandy',
            'Humbolt',
            'North Denver',

        ];
    }

    /**
     * Returns a set of cities names.
     *
     * @return string[]
     */
    public static function getCities(): array
    {
        return [
            'Miami',
            'Denver',
            'Colorado Springs',
            'Hialeah',
            'Kendal',
            'Cape Star',
            'New York',
            'San Diego',
            'St. Louis',
            'St. Lake City',
        ];
    }

    /**
     * Returns a set of states names.
     *
     * @return string[]
     */
    public static function getStates(): array
    {
        return [
            'FL',
            'NY',
            'CO',
            'OK',
            'CA',
            'TX',
            'AL',
            'WY',
            'IL',
            'NC',
        ];
    }


    /**
     * Returns a set of domains.
     *
     * @return string[]
     */
    public static function getDomains(): array
    {
        return [
            'com',
            'cu',
            'us',
            'org',
            'fr',
            'it',
        ];
    }

    /**
     * Returns a set of special chars
     *
     * @return string[]
     */
    public static function getSpecialChars(): array
    {
        return [
            ' ',
            '-!',
            '*',
            '/',
            '+',
            '.',
            '(',
            ')',
            ';',
            ',',
            ':',
            '<',
            '>',
            '|',
            '@',
            '[',
            ']',
            '#',
            '$',
            '%',
            '&',
            '^'
        ];
    }

    /**
     * Returns a set of email servers.
     *
     * @return string[]
     */
    public static function getEmailServerNames(): array
    {
        return [
            'gmail',
            'hotmail',
            'aol',
            'yahoo',
        ];
    }

    /**
     * Generates a letter.
     *
     * @return string
     */
    public static function randomLetter(): string
    {
        $dictionary = self::_getLetters();

        return $dictionary[rand(0, strlen($dictionary) - 1)];
    }

    /**
     * Gets an array of business names.
     *
     * @return string[]
     */
    public static function getBusinessNames(): array
    {
        return [
            'ABC Sports',
            'Macfish Sea Food',
            "Dinno's Restaurant",
            'Catmix Distribuitor',
            'SuperCargo LLC',
            'GMC Corporations',
            'Y2K LLC',
        ];
    }

    /**
     * Generates a letter dictionary.
     *
     * @return string
     */
    protected static function _getLetters(): string
    {
        return 'qwertyuioplkjhgfdsazxcvbnm';
    }
}