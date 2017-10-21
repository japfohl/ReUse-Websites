<?php
// autoload stuff
require_once dirname(__FILE__).'/../vendor/autoload.php';

// make using our class names nicer
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

// example test case
class ApiTestCase extends TestCase
{
	public function reUseDbXmlIsValid($res)
    {
        // TODO: Convert all of the simple logic tests to use PHPUnit assertions

        // convert the response body to an XML element
        $xml = new SimpleXMLElement((string) $res->getBody());

        // verify root name and child count
        if ($xml->getName() != 'reuse')
            return $this->_Fail("Invalid ReUse DB XML root name.");

        // varify child count
        if ($xml->count() != 2)
            return $this->_Fail("Incorrect number of children under 'reuse' root node.");

        // verify the revision tag name
        if ($xml->children()[0]->getName() != 'Revision')
            return $this->_Fail("Invalid ReUse DB Revision tag name.");

        // get and the business list
        $businessList = $xml->children()[1];

        // verify tag name
        if ($businessList->getName() != 'BusinessList')
            return $this->_Fail("Invalid BusinessList tag name");

        // verify tag count
        if ($businessList->count() < 1)
            return $this->_Fail("BusinessList has no children.");

        // validate each business in the business list
        foreach ($businessList->children() as $business)
        {
            // validate tag name
            if ($business->getName() != 'business')
                return $this->_Fail("Malformed 'business' tag name.");

            // verify child count
            if ($business->count() != 5)
                return $this->_Fail("Incorrect child count in 'reuse>BusinessList>business' tag");

            // get id tag
            $id = $business->children()[0];

            // verify tag name
            if ($id->getName() != 'id')
                return $this->_Fail("Malforned 'id' tag name.");

            // verify child count
            if ($id->count() != 0)
                return $this->_Fail("id tag has children when it should have none");

            // get name tag
            $name = $business->children()[1];

            // verify tag name
            if ($name->getName() != 'name')
                return $this->_Fail("Malformed 'name' tag name.");

            // verify child count
            if ($name->count() != 0)
                return $this->_Fail("name tag has children when it should have none");

            // get contact info tage
            $contactInfo = $business->children()[2];

            // verify tag name
            if ($contactInfo->getName() != 'contact_info')
                return $this->_Fail("Malformed 'contact_info' tag name.");

            // verify child count
            if ($contactInfo->count() != 4)
                return $this->_Fail("contact_info has incorrect number of tags");

            $i = 0; // loop index counter
            // validate structure of contactInfo children
            foreach ($contactInfo->children() as $info)
            {
                switch ($i)
                {
                    case 0:
                        // validate tag name
                        if ($info->getName() != 'address')
                            return $this->_Fail("malformed name for tag address");

                        // validate child count
                        if ($info->count() != 5)
                            return $this->_Fail("invalid number of children under 'address; tag");

                        $j = 0; // array index counter
                        // validate each line of the address
                        foreach ($info->children() as $line)
                        {
                            switch($j)
                            {
                                case 0:
                                    // validate tag name
                                    if ($line->getName() != 'address_line_1')
                                        return $this->_Fail("Malformed name for tag 'address_line_1'");
                                    break;
                                case 1:
                                    // validate tag name
                                    if ($line->getName() != 'address_line_2')
                                        return $this->_Fail("Malformed name for tag 'address_line_2'");
                                    break;
                                case 2:
                                    // validate tag name
                                    if ($line->getName() != 'city')
                                        return $this->_Fail("Malformed name for tag 'city'");
                                    break;
                                case 3:
                                    // validate tag name
                                    if ($line->getName() != 'state')
                                        return $this->_Fail("Malformed name for tag 'state'");
                                    break;
                                case 4:
                                    // validate tag name
                                    if ($line->getName() != 'zip')
                                        return $this->_Fail("Malformed name for tag 'zip'");
                                    break;
                            }
                            // validate no more children
                            if ($line->count() != 0)
                                return $this->_Fail("address child has children when it should have none");
                            $j++;
                        }
                        break;
                    case 1:
                        // validate tag name
                        if ($info->getName() != 'phone')
                            return $this->_Fail('malformed name for tag \'phone\'');

                        // validate no more children
                        if ($info->count() != 0)
                            return $this->_Fail("'phone' tag has children when it should have none");
                        break;
                    case 2:
                        // validate tag name
                        if ($info->getName() != 'website')
                            return $this->_Fail('malformed name for tag \'website\'');

                        // validate no more children
                        if ($info->count() != 0)
                            return $this->_Fail("'website' tag has children when it should have none");
                        break;
                    case 3:
                        // validate tag name
                        if ($info->getName() != 'latlong')
                            return $this->_Fail("malformed name for tag 'latlong'");

                        // validate child count
                        if ($info->count() != 2)
                            return $this->_Fail("incorrect child count for tag 'latlong'");

                        // validate latitude
                        if ($info->children()[0]->getName() != 'latitude')
                            return $this->_Fail("malformed name for tag 'latitude'");

                        if ($info->children()[0]->count() != 0)
                            return $this->_Fail("incorrect child count for tag 'latitude'");

                        // validate longitude
                        if ($info->children()[1]->getName() != 'longitude')
                            return $this->_Fail("malformed name for tag 'longitude'");

                        if ($info->children()[1]->count() != 0)
                            return $this->_Fail("incorrect child count for tag 'longitude'");
                        break;
                }
                $i++;
            }

            $categoryList = $business->children()[3];
            if ($categoryList->getName() != 'category_list')
                return $this->_Fail("Malformed \'category_list\' tag name.");

            if ($categoryList->count() > 0)
            {
                // validate structure of categoryList children
                foreach ($categoryList->children() as $category)
                {
                    // verify tag name
                    if ($category->getName() != 'category')
                        return $this->_Fail("malformed name for tag 'category'");

                    // verify child count
                    if ($category->count() != 2)
                        return $this->_Fail("tag 'category' has invalid number of children");

                    // verify child tag names
                    if ($category->children()[0]->getName() != 'name')
                        return $this->_Fail("malformed name for tag 'name' (under caregory)");

                    $subcategoryList = $category->children()[1];
                    if ($subcategoryList->getName() != 'subcategory_list')
                        return $this->_Fail("malformed name for tag 'category_list'");

                    // validate subcategory_list has at least one child with name subcategory
                    if ($subcategoryList->count() == 0)
                        return $this->_Fail("subcategory_list has no children and should have >= 1");

                    if ($subcategoryList->children()[0]->getName() != 'subcategory')
                        return $this->_Fail('malforned name for tag "subcategory"');
                }
            }

            $linkList = $business->children()[4];
            if ($linkList->getName() != 'link_list')
                return $this->_Fail("Malformed \'link_list\' tag name.");

            if ($linkList->count() > 0)
            {
                // validate structure of linkList children
                foreach ($linkList->children() as $link)
                {
                    // validate name
                    if ($link->getName() != 'link')
                        return $this->_Fail('malformed \'link\' tag name');

                    // validate only 2 children
                    if ($link->count() != 2)
                        return $this->_Fail('link should only have 2 children');

                    // validate name child
                    if ($link->children()[0]->getName() != 'name')
                        return $this->_Fail("malformed 'link_list>link>name' tag name");

                    if ($link->children()[0]->count() != 0)
                        return $this->_Fail("link name should have no children");

                    // validate URI child
                    if ($link->children()[1]->getName() != 'URI')
                        return $this->_Fail("malformed name for tag 'URI'");

                    if ($link->children()[1]->count() != 0)
                        return $this->_Fail('URI should have 0 children');
                }
            }
        }

        // if the script gets to this point, everything has checked out so we can return true
        return array(
            "res" => true,
            "msg" => 'XML structure is valid.'
        );
    }

    public function _Fail($msg)
    {
        return array(
            "res" => false,
            "msg" => $msg
        );
    }

    public function validateGoodRequest($response)
    {
    // verify the request was good
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals("OK", $response->getReasonPhrase());
    }

    public function validateContentType($response)
    {
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