<?php
/**
 * Created by PhpStorm.
 * User: lunweiwei
 * Date: 2017/8/3
 * Time: 上午11:33
 */

namespace App\Aip\Utils;


class AipSignOption
{
    const EXPIRATION_IN_SECONDS = 'expirationInSeconds';

    const HEADERS_TO_SIGN = 'headersToSign';

    const TIMESTAMP = 'timestamp';

    const DEFAULT_EXPIRATION_IN_SECONDS = 1800;

    const MIN_EXPIRATION_IN_SECONDS = 300;

    const MAX_EXPIRATION_IN_SECONDS = 129600;
}