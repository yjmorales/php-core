<?php

namespace Common\Utils\Enum;

use Exception;
use Generator;

trait TEnum
{
    private static array $_definitions;

    private static array $_ordinals;

    private static bool $_isInitialized = false;

    private static array $_enums = [];

    private string $_name;

    private int $_ordinal;

    public final function getName(): string
    {
        return $this->_name;
    }

    public final function getOrdinal(): int
    {
        return $this->_ordinal;
    }

    public function __toString(): string
    {
        return $this->_name;
    }

    public static final function __callStatic($name, $ignored)
    {
        return self::_getByName($name);
    }

    private final function __construct($name, $ordinal)
    {
        self::_initialize();

        if (!isset(self::$_definitions[$name])) {
            throw new Exception($name, self::getNames());
        }

        $this->_name    = $name;
        $this->_ordinal = $ordinal;
        $this->_populate(self::$_definitions[$name]);
    }

    protected static function _initializeDefinitions(): array
    {
        return [];
    }

    private static function _initialize(): void
    {
        if (self::$_isInitialized) {
            return;
        }

        self::$_definitions   = self::_initializeDefinitions();
        self::$_ordinals      = array_keys(self::$_definitions);
        self::$_isInitialized = true;
    }

    private static function _getByName($name)
    {
        $name = (string)$name;
        if (isset(self::$_enums[$name])) {
            return self::$_enums[$name];
        }

        self::_initialize();

        return self::$_enums[$name] = new static($name, array_search($name, self::$_ordinals));
    }

    public final static function getNames(): array
    {
        self::_initialize();

        return array_keys(self::$_definitions);
    }

    public final static function getValues(): Generator
    {
        self::_initialize();

        foreach (self::$_definitions as $name => $junk) {
            yield static::$name();
        }
    }

    public final static function findByOrdinal($ordinal)
    {
        $ordinal = (int)$ordinal;
        if (isset(self::$_ordinals[$ordinal])) {
            return self::_getByName(self::$_ordinals[$ordinal]);
        }

        throw new Exception('Not found');
    }

    abstract protected function _populate(array $definition): void;
}