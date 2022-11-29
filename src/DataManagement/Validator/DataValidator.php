<?php
/**
 * @author Yenier Jimenez <yjmorales86@gmail.com>
 */

namespace Common\DataManagement\Validator;

/**
 * This class validates data. The data are scalar data.
 */
class DataValidator
{
    /**
     * Validates an value is a valid string.
     *
     * @param mixed    $subject   Value to be validated.
     * @param int|null $min       Min length.
     * @param int|null $max       Max length.
     * @param bool     $mandatory Indicator of whether the value is required or not.
     *
     * @return bool
     */
    public function isValidString($subject, int $min = null, int $max = null, bool $mandatory = true): bool
    {
        if (is_bool($subject) || !$this->_validateCommon($subject)) {
            return false;
        }

        $subject = (string)$subject;
        if ($this->_validateMandatory($subject, $mandatory)) {
            return false;
        }

        $len = mb_strlen($subject);

        return ($len >= (int)$min && ($max === null || $len <= (int)$max));
    }

    /**
     * Validates a value is a valid boolean.
     *
     * @param mixed $subject Value to validate.
     *
     * @return bool
     */
    public function isValidBoolean($subject): bool
    {
        return $this->_validateCommon($subject);
    }

    /**
     * Validates a value is a valid float.
     *
     * @param mixed    $subject          Value to validate.
     * @param int      $scale            Comparison scale.
     * @param int|null $min              Min allowed value.
     * @param int|null $max              Max allowed value.
     * @param int|null $maxDecimalPlaces Max allowed decimal places.
     * @param bool     $mandatory        Indicator of whether the value is required or not.
     *
     * @return bool
     */
    public function isValidFloat(
        $subject,
        int $scale = 8,
        int $min = null,
        int $max = null,
        int $maxDecimalPlaces = null,
        bool $mandatory = true
    ): bool {
        if (is_bool($subject) || !$this->_validateCommon($subject)) {
            return false;
        }

        $strSubject = (string)$subject;
        if ($this->_validateMandatory($subject, $mandatory)) {
            return false;
        }

        $regex = '/^[-+]?[0-9]*\.?[0-9]+$/';
        if (!preg_match($regex, $strSubject)) {
            return false;
        }
        $floatSubject = (float)$subject;

        if ($floatSubject === INF || $floatSubject === -INF || is_nan($floatSubject)) {
            return false;
        }

        if (!preg_match($regex, (string)$floatSubject)) {
            return false;
        }

        if ($min !== null && bccomp((string)$min, $strSubject, $scale) === 1) {
            return false;
        }

        if ($max !== null && bccomp($strSubject, (string)$max, $scale) === 1) {
            return false;
        }

        if ($maxDecimalPlaces === null) {
            return true;
        }

        return !strpos($strSubject, '.') || strlen(explode('.', $strSubject)[1]) <= $maxDecimalPlaces;
    }

    /**
     * Holds common validations.
     *
     * @param mixed $subject
     *
     * @return bool
     */
    private function _validateCommon($subject): bool
    {
        $isValid = true;
        $isValid &= !$this->_isCompoundType($subject);
        $isValid &= $this->_isSafeString((string)$subject);

        return $isValid;
    }

    /**
     * Validates the value is provided or not according the mandatory flag.
     *
     * @param mixed $subject   Value to be validated.
     * @param bool  $mandatory Requirement indicator.
     *
     * @return bool
     */
    private function _validateMandatory($subject, bool $mandatory): bool
    {
        $subject = (string)$subject;
        if ($mandatory && empty($subject)) {
            return false;
        }

        return true;
    }

    /**
     * Method used to validate the string is safe to be used.
     *
     * @param mixed $subject The value to validate.
     *
     * @return bool
     */
    private function _isSafeString($subject): bool
    {
        $danger  = [
            "\0",
            "%x",
            "%n",
            "%s",
            "%%",
            "%p",
            "%d",
            "%c",
            "%u",
        ];
        $isValid = true;
        foreach ($danger as $item) {
            $isValid &= false === strpos($subject, $item);
        }

        return $isValid;
    }

    /**
     * Used to determinate whether the subject is compound type.
     *
     * @link https://www.php.net/manual/en/language.types.intro.php
     *
     * @param mixed $subject The value to evaluate.
     *
     * @return bool
     */
    private function _isCompoundType($subject): bool
    {
        return (is_object($subject) || is_array($subject)) || is_callable($subject) || is_iterable($subject);
    }
}