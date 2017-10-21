<?php
// autoload stuff
require_once dirname(__FILE__).'/../../vendor/autoload.php';

// make using our class names nicer
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

// example test case
final class AdminRoutesTest extends TestCase
{
    // the GuzzleHttp client
    protected $client;

    // create a new Guzzle client before running each test
    protected function setUp()
    {
        $this->client = new Client(['base_uri' => getenv('API_ADDR')]);
    }

    // example test method called on the GET /hello/{name} route
    public function testHelloNameRouteReturnsHelloAndProvidedName()
    {
        $response = $this->client->request('GET', '/hello/testName');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testAddBusinessDocRoute()
    {
        $response = $this->client->request('POST', '/RUapi/addBusinessDoc', [
            'json' => ['doc_name' => 'my_special_document', 
                       'doc_url' => 'https://www.google.com',
                       'business_id' => 1]
        ]);

        $this->assertEquals(200, $response->getStatusCode());
    }
}