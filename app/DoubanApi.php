<?php
/**
 * Created by PhpStorm.
 * User: lunweiwei
 * Date: 2017/8/9
 * Time: 上午11:59
 */

namespace App;


class DoubanApi
{
    const BASE_CONFIG = [
        'base_uri' => 'https://frodo.douban.com',
        'timeout' => 2.0,
    ];

    const BASE_HEADERS = [
        'Host' => 'frodo.douban.com',
        'User-Agent' => 'api-client/0.1.3 com.douban.frodo/5.2.0 iOS/10.3.3 iPhone7,1 network/wifi',
        'Accept-Language' => 'zh-Hans-CN;q=1, en-CN;q=0.9',
        'Authorization' => 'Bearer 2445ee3cb351d8596cd1cab619f5890b',
    ];

    const BASE_QUERY = [
        '_sig' => 'oHFPQrYzv9dnCHOCa2UcgO6quTo%3D',
        '_ts' => 1502248066,
        'alt' => 'json',
        'apikey' => '0ab215a8b1977939201640fa14c66bab',
        'count' => 100,
        'douban_udid' => 'fcc1282b79a86f2ab057801dfaeaf14fd53be005',
        'latitude' => 39.91638121664516,
        'loc_id' => 108288,
        'longitude' => 116.5482341778619,
        'start' => 0,
        'udid' => '6c939601b46053bd3ad1ecb0d9c9f48e2e0dbfa5',
        'version' => '5.2.0',
    ];
}