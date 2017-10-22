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
    }

    // tearDown is run after each test in a class that extends TestCase
    protected function tearDown() {
        
        $this->client = null;
        $this->deleteTestLocations();
        $this->locIDs = null;
        $this->db->close();
    }

    /************************************** TESTS ***************************************/

    public function testAllTestLocationsSuccessfullyAdded() {
        
        // verify array of ID's is of length 4
        $this->assertEquals(4, count($this->locIDs));

        // print information for each inserted location
        foreach ($this->locIDs as $id) {
            $res = $this->db->query("SELECT * FROM Reuse_Locations WHERE id = $id;");
            $this->assertNotFalse($res);
        }
    }

    public function testLatLongsRouteUpdatesTestDataAndRegeneratesXmlDatabase() {
        // TODO: verify that test data does not have latitude and longitude

        // TODO: grab and store a copy of the XML DB

        // TODO: Make the call to the route
        
        // TODO: Verify the test data now has latitude and longitude

        // TODO: Get a new copy of the xml db

        // TODO: Verify the new xml DB is different from the old XML DB
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
             VALUES ('Test Business 1', '123 6th Ave', 'Melbourne', 9, 32903);",
             "INSERT INTO Reuse_Locations (name, address_line_1, city, state_id, zip_code)
             VALUES ('Test Business 2', '5530 Wisconsin Ave', 'Chevy Chase', 20, 20815);",
             "INSERT INTO Reuse_Locations (name, address_line_1, city, state_id, zip_code)
             VALUES ('Test Business 3', '1625 E 75th St', 'Chicago', 13, 60649);",
             "INSERT INTO Reuse_Locations (name, address_line_1, city, state_id, zip_code)
             VALUES ('Test Business 4', '7791 Thornhill Ct', 'Springboro', 35, 45066);"
        ];

        foreach ($queries as $query) {
            $this->db->query($query);
            $tempIds[] = $this->db->insert_id;
        }

        return $tempIds;
    }
}