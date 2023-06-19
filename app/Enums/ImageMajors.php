<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class ImageMajors extends Enum
{
    const ONE =  1;
    const Two =  2;
    const Three = 3;
    const Four = 4;
    const Five = 5;
    public static function getDescription($value): string
    {
        switch ($value) {
            case self::ONE:
                return 'la la-bullhorn';
                break;
            case self::Two:
                return 'la la-graduation-cap';
                break;
            case self::Three:
                return 'la la-line-chart';
                break;
            case self::Four:
                return 'la la-users';
                break;
            case self::Five:
                return 'la la-phone';
                break;
            default:
                return '';
                break;
        }
    }
    public static function parseArray()
    {
        $data = [];
        foreach (self::getValues() as $value) {
            $data[] = ['label' => self::getDescription($value), 'id' => $value];
        }

        return $data;
    }
}
