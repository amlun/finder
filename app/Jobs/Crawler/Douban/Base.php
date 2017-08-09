<?php
/**
 * Created by PhpStorm.
 * User: lunweiwei
 * Date: 2017/8/9
 * Time: 上午11:21
 */

namespace App\Jobs\Crawler\Douban;

use App\DoubanApi;
use App\Jobs\Crawler\Job;
use Log;
use GuzzleHttp\Client;

/**
 * Class Base
 * @package App\Jobs\Crawler\Douban
 */
abstract class Base extends Job
{
    const URI_REGEX = '';

    protected $uri;

    public function __construct($id)
    {
        $this->uri = sprintf(static::URI_REGEX, $id);
    }

    public function handle()
    {
        if (empty($this->uri)) {
            return;
        }
        try {
            $client = new Client(DoubanApi::BASE_CONFIG);
            $response = $client->get($this->uri, [
                'headers' => DoubanApi::BASE_HEADERS,
                'query' => DoubanApi::BASE_QUERY
            ]);
            $status = $response->getStatusCode();
            if (200 !== $status) {
                throw new \Exception('request fail with status ' . $status);
            }
            $body = $response->getBody();
            $body = json_decode($body, true);
            $this->on_handle($body);
            Log::info('crawl douban success', ['uri' => $this->uri]);
        } catch (\Exception $e) {
            Log::error($e->getMessage(), ['uri' => $this->uri]);
        }
    }

    abstract function on_handle($body);
}