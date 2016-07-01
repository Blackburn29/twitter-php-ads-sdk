<?php

namespace Hborras\TwitterAdsSDK\Ton;

use Hborras\TwitterAdsSDK\TwitterAds;

class TonFileTest extends \PHPUnit_Framework_TestCase
{
    private $twitter;

    /**
     * @group ton
     */
    public function testSingleFilesCanBeUploadedSuccessfully()
    {
        $file = new TonFile(__DIR__.'/../video.mp4', 'text/plain');

        $body = $this->twitter->uploadFile($file, 'ta_partner');

        $this->assertEquals(201, $this->twitter->getResponse()->getHttpCode());
    }

    protected function setUp()
    {
        $this->twitter = new TwitterAds(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET, false);
    }
}
