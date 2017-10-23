<?php
// autoload stuff
require_once dirname(__FILE__).'/../../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

final class LatitudeAndLongitudeRoutesTest extends TestCase {

    // class level variables accessible by each test being run
    protected $client;  // guzzle client
    protected $db;      // mysqli client
    protected $locIDs;  // array of ids for test data added

    /********************************* SETUP & TEARDOWN *********************************/

    // setup is run before each test in a class that extends TestCase
    protected function setUp() {

        $this->client = new Client(['base_uri' => getenv('API_ADDR')]);
        $this->db = connectReuseDB();
        $this->locIDs = $this->insertTestLocations();
        reuse_generateXML();
    }

    // tearDown is run after each test in a class that extends TestCase
    protected function tearDown() {

        $this->client = null;
        $this->deleteTestLocations();
        $this->locIDs = null;
        $this->db->close();
        reuse_generateXML();
    }

    /************************************** TESTS ***************************************/

    public function testAllTestLocationsSuccessfullyAdded() {

        // verify array of ID's is of length 4
        $this->assertEquals(4, count($this->locIDs));

        // verify selecting from the DB using the stored ids results in a non-false result
        foreach ($this->locIDs as $id) {
            $res = $this->db->query(
                "SELECT *
                 FROM Reuse_Locations
                 WHERE id = $id;"
            );
            $this->assertNotFalse($res);
        }
    }

    public function testLatLongsRouteAddsLatitudeAndLongitudeToTestData() {

        // verify that test data does not have latitude and longitude
        foreach ($this->locIDs as $id) {

            // get the latitude and longitude
            $res = $this->db->query(
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
            $res = $this->db->query(
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
        $this->assertEquals('application/xml', $res->getHeader('content-type')[0]);
        $startReuseDb = new SimpleXMLElement((string) $res->getBody());

        // TODO: Make the call to the route

        // TODO: Get a new copy of the xml db

        // TODO: Verify the new xml DB is different from the old XML DB

        // TODO: Verify the latitude and longitude of the test data matches the info in the xml db
    }

    /***************************** PRIVATE HELPER FUNCTIONS *****************************/

    private function deleteTestLocations() {

        foreach ($this->locIDs as $id) {
            $this->db->query("DELETE FROM Reuse_Locations WHERE id = $id;");
        }
    }

    // create four test locations with valid addresses
    private function insertTestLocations() {

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
            $this->db->query($query);
            $tempIds[] = $this->db->insert_id;
        }

        return $tempIds;
    }
}