<?php
// autoload stuff
require_once dirname(__FILE__).'/../../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

final class LatitudeAndLongitudeRoutesTest extends TestCase
{
    protected $client;  // Guzzle HTTP client
    protected $mysqli;  // mysqli client

    // create a new Guzzle client before running each test
    protected function setUp()
    {
        // create a new Guzzle HTTP client
        $this->client = new Client(['base_uri' => getenv('API_ADDR')]);

        // create a new mysqli client

    }

    protected function tearDown()
    {
        // tear down the Guzzle client so it can be GCed
        $this->client = null;


    }
}