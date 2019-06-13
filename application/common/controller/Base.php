<?php
/**
 *      [Starsriver] (C)2014-2099.
 *      This is NOT a freeware, follows Apache2.0 licence
 *
 *      Author: 张宇
 *      Email:  starsriver@yahoo.com
 *      CreateDate:   2017-08-05
 *
 */

namespace app\common\controller;

use think\Controller;
use think\Db;
use app\common\Config;

class Base extends Controller {

    public static function baseinfo($more = true) {

        $data = [
            'webname' => Config::getconf('info','webname'),
        ];

        if($more){
            $allvisite = count(Db::query("select vid from qzlit_log"));
            $navarg = '`id`, `name`, `bel`, `url`, `key`,`blank`';
            $mainnav = Db::query("select " . $navarg . " from qzlit_nav WHERE active != 0 AND type = '1' ORDER BY `order` ASC ");
            $searchnav = Db::query("select " . $navarg . "  from qzlit_nav WHERE active != 0 AND type = '2' ORDER BY `order` ASC ");
            $foonav = Db::query("select " . $navarg . "  from qzlit_nav WHERE active != 0 AND type = '3' ORDER BY `order` ASC ");

            $data += [
                'allvisite' => $allvisite,
                'mainnav' => $mainnav,
                'searchnav' => $searchnav,
                'foonav' => $foonav,
            ];
        }

        return $data;
    }
}