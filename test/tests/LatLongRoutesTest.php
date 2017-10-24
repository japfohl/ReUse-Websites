<?php
// autoload stuff
require_once dirname(__FILE__).'/../../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

final class LatitudeAndLongitudeRoutesTest extends TestCase {

    // class level variables accessible by each test being run
    protected $client;  // guzzle client
    protected $locIDs;  // array of ids for test data added

    /********************************* SETUP & TEARDOWN *********************************/

    // setup is run before each test in a class that extends TestCase
    protected function setUp() {

        $this->client = new Client(['base_uri' => getenv('API_ADDR')]);
        $this->locIDs = $this->insertTestLocations();
        reuse_generateXML();
    }

    // tearDown is run after each test in a class that extends TestCase
    protected function tearDown() {

        $this->client = null;
        $this->deleteTestLocations();
        $this->locIDs = null;
        reuse_generateXML();
    }

    /************************************** TESTS ***************************************/

    public function testAllTestLocationsSuccessfullyAdded() {

    	// get the db connection
		$db = connectReuseDB();

        // verify array of ID's is of length 4
        $this->assertEquals(4, count($this->locIDs));

        // verify selecting from the DB using the stored ids results in a non-false result
        foreach ($this->locIDs as $id) {
            $res = $db->query(
                "SELECT *
                 FROM Reuse_Locations
                 WHERE id = $id;"
            );
            $this->assertNotFalse($res);
        }
    }

    public function testLatLongsRouteAddsLatitudeAndLongitudeToTestData() {

    	// get the db
		$db = connectReuseDB();

        // verify that test data does not have latitude and longitude
        foreach ($this->locIDs as $id) {

            // get the latitude and longitude
            $res = $db->query(
                "SELECT latitude, longitude
                 FROM Reuse_Locations
                 WHERE id = $id;"
            );
            $loc = $res->fetch_assoc();

            // verify both are null
            $this->assertNull($loc['latitude']);
            $this->assertNull($loc['longitude']);
        }

        // Make the call to the route
        $res = $this->client->request('GET', '/setLatLongs');
        $this->assertEquals(200, $res->getStatusCode());
        $this->assertEquals("OK", $res->getReasonPhrase());

        // Verify the test data now has latitude and longitude
        foreach ($this->locIDs as $id) {

            // get the latitude and longitude
            $res = $db->query(
                "SELECT latitude, longitude
                 FROM Reuse_Locations
                 WHERE id = $id;"
            );
            $loc = $res->fetch_assoc();

            // verify both are not null
            $this->assertNotNull($loc['latitude']);
            $this->assertStringMatchesFormat("%f", $loc['latitude']);
            $this->assertNotNull($loc['longitude']);
            $this->assertStringMatchesFormat("%f", $loc['longitude']);
        }
    }

    public function testLatLongRoutesUpdatesXmlDatabaseWithNewLatitudeAndLongitudes() {

        // grab and store a copy of the XML DB as it looks prior to calling the route
        $res = $this->client->request('GET', '/reuseDB');
        $this->assertEquals(200, $res->getStatusCode());
        $this->assertEquals("OK", $res->getReasonPhrase());
        $this->validateContentType($res);
        $startReuseDb = (string) $res->getBody();

        // Make the call to the route
        $res = $this->client->request('GET', '/setLatLongs');
        $this->assertEquals(200, $res->getStatusCode());
        $this->assertEquals("OK", $res->getReasonPhrase());

        // Get a new copy of the xml db
        $res = $this->client->request('GET', '/reuseDB');
        $this->assertEquals(200, $res->getStatusCode());
        $this->assertEquals("OK", $res->getReasonPhrase());
        $this->validateContentType($res);
        $newReuseDb = (string) $res->getBody();

        // Verify the new xml DB is different from the old XML DB
        $this->assertXmlStringNotEqualsXmlString($startReuseDb, $newReuseDb);

        // Verify that test data exists in the xml document and has a latitude and longitude
        $reuseXML = new SimpleXMLElement($newReuseDb);
        foreach ($this->locIDs as $id) {

            // get the business matching the 
            $location = $reuseXML->xpath("/reuse/BusinessList/business[id = $id]");
            $this->assertNotFalse($location);
            
            // get the value of the latitude and longitude
            $lat = $location[0]->xpath("contact_info/latlong/latitude");
            $long = $location[0]->xpath("contact_info/latlong/latitude");

            // make sure there are good latitude and longitude values stored
            $this->assertStringMatchesFormat("%f", (string) $lat[0]);
            $this->assertStringMatchesFormat("%f", (string) $long[0]);
        }
    }

    /***************************** PRIVATE HELPER FUNCTIONS *****************************/

    private function deleteTestLocations() {

    	// get the db
		$db = connectReuseDB();

        foreach ($this->locIDs as $id) {
            $db->query("DELETE FROM Reuse_Locations WHERE id = $id;");
        }
    }

    // create four test locations with valid addresses
    private function insertTestLocations() {

    	// get the database connection
		$db = connectReuseDB();

        $tempIds = array();

        $queries = [
            "INSERT INTO Reuse_Locations (name, address_line_1, city, state_id, zip_code)
             VALUES ('Test Business 1', '123 6th Ave', 'Indialantic', 9, 32903);",
             "INSERT INTO Reuse_Locations (name, address_line_1, city, state_id, zip_code)
             VALUES ('Test Business 2', '5530 Wisconsin Ave', 'Chevy Chase', 20, 20815);",
             "INSERT INTO Reuse_Locations (name, address_line_1, city, state_id, zip_code)
             VALUES ('Test Business 3', '1625 E 75th St', 'Chicago', 13, 60649);",
             "INSERT INTO Reuse_Locations (name, address_line_1, city, state_id, zip_code)
             VALUES ('Test Business 4', '1111 W 11th St', 'Austin', 43, 78703);"
        ];

        foreach ($queries as $query) {
            $db->query($query);
            $tempIds[] = $db->insert_id;
        }

        return $tempIds;
    }

    private function validateContentType($response) {

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