<?php
// autoload stuff
require_once dirname(__FILE__).'/../../vendor/autoload.php';

// make using our class names nicer
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

// example test case
class ApiTestCase extends TestCase {
    
    protected function reUseDbXmlIsValid($res) {
        
        // convert the response body to an XML element
        $xml = new SimpleXMLElement((string) $res->getBody());

        $this->assertEquals('reuse', $xml->getName(),
            "Invalid root tag value.  Expected \'reuse\' but got ". $xml->getName()
        );

        $this->assertEquals(2, $xml->count());

        $revision = $xml->xpath('./Revision');
        $this->assertNotFalse($revision);
        $this->assertEquals('Revision', $revision[0]->getName());

        // get the business list
        $businessList = $xml->xpath('./BusinessList');
        $this->assertNotFalse($businessList);
        $businessList = $businessList[0];
        $this->assertEquals('BusinessList', $businessList->getName());
        $this->assertGreaterThanOrEqual(1, $businessList->count());
        
        // validate each business in the business list
        foreach ($businessList->children() as $business) {
            
            // validate business
            $this->assertEquals('business', $business->getName());
            $this->assertEquals(5, $business->count());
        
            // validate id
            $id = $business->xpath('./id');
            $this->assertNotFalse($id);
            $id = $id[0];
            $this->assertEquals('id', $id[0]->getName());
            $this->assertEquals(0, $id[0]->count());
        
            // validate name
            $name = $business->xpath('./name');
            $this->assertNotFalse($name);
            $name = $name[0];
            $this->assertEquals('name', $name[0]->getName());
            $this->assertEquals(0, $name[0]->count());
        
            // get contact info tage
            $contactInfo = $business->xpath('./contact_info');
            $this->assertNotFalse($contactInfo);
            $contactInfo = $contactInfo[0];
            $this->assertEquals('contact_info', $contactInfo->getName());
            $this->assertEquals(4, $contactInfo->count());
        
            $phone = $contactInfo->xpath('./phone');
            $this->assertNotFalse($phone);
            $phone = $phone[0];
            $this->assertEquals('phone', $phone->getName());
            $this->assertEquals(0, $phone->count());
        
            $website = $contactInfo->xpath('./website');
            $this->assertNotFalse($website);
            $website = $website[0];
            $this->assertEquals('website', $website->getName());
            $this->assertEquals(0, $website->count());
        
            $address = $contactInfo->xpath('./address');
            $this->assertNotFalse($address);
            $address = $address[0];
            $this->assertEquals('address', $address->getName());
            $this->assertEquals(5, $address->count());
        
            $line1 = $address->xpath('./address_line_1');
            $this->assertNotFalse($line1);
            $line1 = $line1[0];
            $this->assertEquals('address_line_1', $line1->getName());
            $this->assertEquals(0, $line1->count());
        
            $line2 = $address->xpath('./address_line_2');
            $this->assertNotFalse($line2);
            $line2 = $line2[0];
            $this->assertEquals('address_line_2', $line2->getName());
            $this->assertEquals(0, $line2->count());
        
            $city = $address->xpath('./city');
            $this->assertNotFalse($city);
            $city = $city[0];
            $this->assertEquals('city', $city->getName());
            $this->assertEquals(0, $city->count());
        
            $state = $address->xpath('./state');
            $this->assertNotFalse($state);
            $state = $state[0];
            $this->assertEquals('state', $state->getName());
            $this->assertEquals(0, $state->count());
        
            $zip = $address->xpath('./zip');
            $this->assertNotFalse($zip);
            $zip = $zip[0];
            $this->assertEquals('zip', $zip->getName());
            $this->assertEquals(0, $zip->count());
        
            $latlong = $contactInfo->xpath('./latlong');
            $this->assertNotFalse($latlong);
            $latlong = $latlong[0];
            $this->assertEquals('latlong', $latlong->getName());
            $this->assertEquals(2, $latlong->count());
        
            $lat = $latlong->xpath('./latitude');
            $this->assertNotFalse($lat);
            $lat = $lat[0];
            $this->assertEquals('latitude', $lat->getName());
            $this->assertEquals(0, $lat->count());
        
            $long = $latlong->xpath('./longitude');
            $this->assertNotFalse($long);
            $long = $long[0];
            $this->assertEquals('longitude', $long->getName());
            $this->assertEquals(0, $long->count());
        
            $catList = $business->xpath('./category_list');
            $this->assertNotFalse($catList);
            $catList = $catList[0];
        
            foreach ($catList->children() as $category) {
                
                $this->assertEquals('category', $category->getName());
                $this->assertEquals(2, $category->count());
        
                $catName = $category->xpath('./name');
                $this->assertNotFalse($catName);
                $catName = $catName[0];
                $this->assertEquals('name', $catName->getName());
                $this->assertEquals(0, $catName->count());
        
                $subCatList = $category->xpath('./subcategory_list');
                $this->assertNotFalse($subCatList);
                $subCatList = $subCatList[0];
                $this->assertEquals('subcategory_list', $subCatList->getName());
        
                foreach ($subCatList->children() as $subcat) {
                    
                    $this->assertEquals('subcategory', $subcat->getName());
                    $this->assertEquals(0, $subcat->count());
                }
            }
        
            $linkList = $business->xpath('./link_list');
            $this->assertNotFalse($linkList);
            $linkList = $linkList[0];
        
            foreach ($linkList->children() as $link) {
                
                $linkName = $link->xpath('./name');
                $this->assertNotFalse($linkName);
                $linkName = $linkName[0];
                $this->assertEquals('name', $linkName->getName());
                $this->assertEquals(0, $linkName->count());
        
                $uri = $link->xpath('./URI');
                $this->assertNotFalse($uri);
                $uri = $uri[0];
                $this->assertEquals('URI', $uri->getName());
                $this->assertEquals(0, $uri->count());
            }
        }
    }

    protected function validateGoodRequest($response) {
        
        // verify the request was good
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals("OK", $response->getReasonPhrase());
    }

    protected function validateContentType($response) {
        
        // should have content-type header
        $this->assertTrue($response->hasHeader('content-type'));

        $addr = getenv('API_ADDR');
        if (strpos($addr, 'localhost') !== false || strpos($addr, '127.0.0.1') !== false) {
            $this->assertEquals('text/xml;charset=UTF-8', $response->getHeader('content-type')[0]);
        } else {
            $this->assertEquals('application/xml', $response->getHeader('content-type')[0]);
        }
    }
}
