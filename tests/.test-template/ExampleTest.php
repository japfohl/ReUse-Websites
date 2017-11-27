<?php
// autoload stuff
require_once dirname(__FILE__).'/../vendor/autoload.php';

// make using our class names nicer
use GuzzleHttp\Client;

// example test case
final class ExampleTest extends ApiTestCase {
    
    // the GuzzleHttp client
    protected $client;

    // create a new Guzzle client before running each test
    protected function setUp() {

        $this->client = new Client(['base_uri' => getenv('API_ADDR')]);
    }

    // example test method called on the GET /hello/{name} route
    public function testHelloNameRouteReturnsHelloAndProvidedName() {

        $response = $this->client->request('GET', '/hello/testName');
        $this->assertEquals(200, $response->getStatusCode());
    }
}