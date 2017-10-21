<?php
// autoload stuff
require_once dirname(__FILE__).'/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;

final class PhoneRoutesTest extends ApiTestCase {

    // class level variables accessible by each test being run
    protected $client;

    // create a new Guzzle client before running each test
    protected function setUp() {

        $this->client = new GuzzleHttp\Client(['base_uri' => getenv('API_ADDR')]);
    }

    public function testWholeReuseDatabaseRoute() {

        // send the request to the route and store the response
        $response = $this->client->request('GET', '/reuseDB');

        // initial basic validations
        $this->validateGoodRequest($response);
        $this->validateContentType($response);
        $this->reUseDbXmlIsValid($response);
    }

    public function testRecyclingCenterNamesOnlyListRoute() {

        // send the request to the route and store the response
        $response = $this->client->request('GET', '/recycleNameXML');

        // initial basic validations
        $this->validateGoodRequest($response);
        $this->validateContentType($response);

        // create a simple xml object from the response body
        $xml = new SimpleXMLElement((string) $response->getBody() );

        // validate the xml structure
        $this->assertEquals('recycle', $xml->getName());
        $this->assertEquals(1, $xml->count());

        $recycleCenterNames = $xml->children()[0];
        $this->assertEquals('recycle_center_names', $recycleCenterNames->getName());

        if ($recycleCenterNames->count() > 0) {

            foreach ($recycleCenterNames->children() as $name) {

                // validate tag name
                $this->assertEquals('name', $name->getName());

                // validate no children
                $this->assertEquals(0, $name->count());
            }
        }
    }

	public function testRecyclingCenterListIncludingAllRelevantDataRoute() {

        // send the request to the route and store the response
        $response = $this->client->request('GET', '/recycleXML');

        // initial basic validations
        $this->validateGoodRequest($response);
        $this->validateContentType($response);

        $xml = new SimpleXMLElement((string) $response->getBody());

        // validate root name
        $this->assertEquals('recycle', $xml->getName());

        // validate one child
        $this->assertEquals(1, $xml->count());

        // get the recycle list
        $recycleList = $xml->children()[0];

        // validate name and >= 1 child
        $this->assertEquals('recycle_list', $recycleList->getName());
        $this->assertGreaterThanOrEqual(1, $recycleList->count());

        // loop over and validate each child of recycle list
        foreach ($recycleList->children() as $business) {

            // validate name and child count
            $this->assertEquals('business', $business->getName());
            $this->assertEquals(5, $business->count());

            // validate id
            $this->assertEquals('id', $business->children()[0]->getName());
            $this->assertEquals(0, $business->children()[0]->count());

            // validate name
            $this->assertEquals('name', $business->children()[1]->getName());
            $this->assertEquals(0, $business->children()[1]->count());

            // validate contact info
            $contactInfo = $business->children()[2];
            $this->assertEquals('contact_info', $contactInfo->getName());
            $this->assertEquals(4, $contactInfo->count());

            // validate address root info
            $address = $contactInfo->children()[0];
            $this->assertEquals('address', $address->getName());
            $this->assertEquals(5, $address->count());

            // validate address_line_1
            $this->assertEquals('address_line_1', $address->children()[0]->getName());
            $this->assertEquals(0, $address->children()[0]->count());

            // validate address_line_2
            $this->assertEquals('address_line_2', $address->children()[1]->getName());
            $this->assertEquals(0, $address->children()[1]->count());

            // validate city
            $this->assertEquals('city', $address->children()[2]->getName());
            $this->assertEquals(0, $address->children()[2]->count());

            // validate state
            $this->assertEquals('state', $address->children()[3]->getName());
            $this->assertEquals(0, $address->children()[3]->count());

            // validate zip
            $this->assertEquals('zip', $address->children()[4]->getName());
            $this->assertEquals(0, $address->children()[4]->count());

            // validate telephone number field
            $this->assertEquals('phone', $contactInfo->children()[1]->getName());
            $this->assertEquals(0, $contactInfo->children()[1]->count());

            // validate website field
            $this->assertEquals('website', $contactInfo->children()[2]->getName());
            $this->assertEquals(0, $contactInfo->children()[2]->count());

            // validate latitude and longitude field
            $latlong = $contactInfo->children()[3];
            $this->assertEquals('latlong', $latlong->getName());
            $this->assertEquals(2, $latlong->count());
            $this->assertEquals('latitude', $latlong->children()[0]->getName());
            $this->assertEquals(0, $latlong->children()[0]->count());
            $this->assertEquals('longitude', $latlong->children()[1]->getName());
            $this->assertEquals(0, $latlong->children()[1]->count());


            // TODO: find out spec for services_list and perform validation here

            // validate the link list
            $linkList = $business->children()[4];
            $this->assertEquals('link_list', $linkList->getName());

            // validate each link in link list
            if ($linkList->count() > 0) {
                foreach ($linkList->children() as $link) {

                    $this->assertEquals('link', $link->getName());
                    $this->assertEquals(2, $link->count());
                    $this->assertEquals('name', $link->children()[0]->getName());
                    $this->assertEquals(0, $link->children()[0]->count());
                    $this->assertEquals('URI', $link->children()[1]->getName());
                    $this->assertEquals(0, $link->children()[1]->count());
                }
            }
        }
    }

    public function testDonorAndSponsorInformationListRoute() {

        // send the request to the route and store the response
        $response = $this->client->request('GET', '/donorXML');

        // initial basic validations
        $this->validateGoodRequest($response);
        $this->validateContentType($response);

        $xml = new SimpleXMLElement((string) $response->getBody());

        // validate the root
        $this->assertEquals('donor', $xml->getName());
        $this->assertEquals(1, $xml->count());

        // get the donor list
        $donorList = $xml->children()[0];
        $this->assertEquals('donor_list', $donorList->getName());

        if ($donorList->count() > 0) {
            foreach ($donorList->children(0) as $donor) {

                // TODO: get donor spec and add validation code here
            }
        }
    }
}
