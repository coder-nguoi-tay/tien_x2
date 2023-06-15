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
                return 'http://127.0.0.1:8000/asset/imags/icone/service-icone-1.png';
                break;
            case self::Two:
                return 'http://127.0.0.1:8000/asset/imags/icone/service-icone-2.png';
                break;
            case self::Three:
                return 'http://127.0.0.1:8000/asset/imags/icone/service-icone-3.png';
                break;
            case self::Four:
                return 'http://127.0.0.1:8000/asset/imags/icone/service-icone-4.png';
                break;
            case self::Five:
                return 'http://127.0.0.1:8000/asset/imags/icone/service-icone-5.png';
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
