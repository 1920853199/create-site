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

namespace App\Http\Requests\Administrator;

use App\Http\Requests\Request;

class SiteGroupRequest extends Request
{
    public function rules()
    {

        switch($this->method())
        {
            // CREATE
            case 'POST':
            {
                return [
                    'site_name' => 'required|min:1|max:191',
                    'keywords' => 'nullable|max:191',
                    'template' => 'nullable|max:191',
                    'template_mobile' => 'nullable|max:191',
                    'director' => 'nullable|max:191',
                    'phone' => 'nullable|max:191',
                    'email' => 'nullable|email|max:191',
                    'status' => 'nullable|integer',
                    'domain' => 'nullable|max:191',
                ];
            }
            // UPDATE
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'site_name' => 'required|min:1|max:191',
                    'keywords' => 'nullable|max:191',
                    'template' => 'nullable|max:191',
                    'template_mobile' => 'nullable|max:191',
                    'director' => 'nullable|max:191',
                    'phone' => 'nullable|max:191',
                    'email' => 'nullable|email|max:191',
                    'status' => 'nullable|integer',
                    'domain' => 'nullable|max:191',
                ];
            }
            case 'GET':
            case 'DELETE':
            default:
            {
                return [];
            };
        }
    }
}
