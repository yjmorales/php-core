<?php
/**
 * @author Yenier Jimenez <yjmorales86@gmail.com>
 */

namespace Common\View\Twig\Filter;

use Common\Utils\Phone\PhoneUtils;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Exception;

/**
 * This class represents a twig extension for formatting plain phone numbers into the formats:
 *
 * (xxx) xxx-xxxx
 * 1 (xxx) xxx-xxxx
 *
 * The file MUST be updated
 *
 * services:
 *      _defaults:
 *            public: false
 *           autowire: true
 *           autoconfigure: true
 *           Twig\Extensions\TextExtension: ~
 *           Sonnys\BackOffice\Core\Twig\DashedPhoneTwigExtension: ~
 *
 *
 * @package Common\View\Twig\Filter
 */
class DashedPhoneTwigExtension extends AbstractExtension
{
    /**
     * @inheritDoc
     */
    public function getFilters()
    {
        return [
            new TwigFilter('dashed', [$this, 'toDashedFormat']),
        ];
    }

    /**
     * Function designed to convert plain phone numbers into the respective dashed format
     *
     * (xxx) xxx-xxx OR 1(xxx) xxx-xxxx
     *
     * @param string $phone
     *
     * @return string
     *
     * @throws Exception
     */
    public function toDashedFormat(string $phone): string
    {
        return PhoneUtils::semiDashed($phone);
    }
}
