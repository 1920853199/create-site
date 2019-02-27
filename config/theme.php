<?php
/**
 * LaraCMS - CMS based on laravel
 *
 * @category  LaraCMS
 * @package   Laravel
 * @author    Wanglelecc <wanglelecc@gmail.com>
 * @date      2018/06/06 09:08:00
 * @copyright Copyright 2018 LaraCMS
 * @license   https://opensource.org/licenses/MIT
 * @github    https://github.com/wanglelecc/laracms
 * @link      https://www.laracms.cn
 * @version   Release 1.0
 */

return [
    'desktop' => env('THEME_DESKTOP', 'desktop'),
    'mobile' => env('THEME_MOBILE', 'mobile'), // default mobile

    'template' => [
        'page' => [
            'show' => [
            ],
        ],

        'category' => [
            'index' => [

            ],
        ],

        'article' => [
            'list' => [

            ],

            'show' => [
                'wll' => '望乐乐',
            ],
        ],
    ],
];