<?php
// autoload stuff
require_once dirname(__FILE__).'/../../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

final class LatitudeAndLongitudeRoutesTest extends TestCase
{
    // CONSTANTS
    const INSERT_QUERY = 'INSERT INTO Reuse_Locations (name, address_line_1, city, state_id, zip_code) VALUES (?, ?, ?, ?, ?);';
    const DELETE_QUERY = 'DELETE FROM Reuse_Locations where id = ?;';
    const NAMES = array('Test Business 1', 'Test Business 2', 'Test Business 3', 'Test Business 4');
    const ADDRESSES = array('123 6th Ave', '5530 Wisconsin Ave', '1625 E 75th St', '7791 Thornhill Ct');
    const CITIES = array('Melbourne', 'Chevy Chase', 'Chicago', 'Springboro');
    const STATES = array('FL', 'MD', 'IL', 'OH');
    const ZIP_CODES = array('32903', '20815', '60649', '45066');

    // class properties
    protected $client;  // Guzzle HTTP client
    protected $db;  // mysqli client
    protected $locIds;  // array of generated location ids


    // create a new Guzzle client before running each test
    protected function setUp()
    {
        $this->client = new Client(['base_uri' => getenv('API_ADDR')]);
        $this->db = connectReuseDB();
        $this->locIds = $this->insertTestLocations();
        if ($this->locIds == null)
        {
           // TODO: handle null location ids 
        }
    }

    protected function tearDown()
    {
        $this->client = null;
        $this->db->close();
        if ($this->locIds != null)
        {
            $this->removeTestLocations($this->locIds);
        }
        $this->locIds = null;
    }

    private function insertTestLocations()
    {
        $ids = array();

        for ($i = 0; $i < count(self::NAMES); $i++)
        {
            if (!($stmt = $this->db->prepare(self::INSERT_QUERY)))
            {
                if (count($ids) > 0)
                {
                    $this->removeTestLocations($ids);
                }
                return null;
            }

            

            if (!($stmt->bind_param(self::NAMES[$i], self::ADDRESSES[$i], self::CITIES[$i], self::STATES[$i], self::ZIP_CODES[$i])))
            {
                if (count($ids) > 0)
                {
                    $this->removeTestLocations($ids);
                }
                return null;
            }

            if (!($stmt->execute()))
            {
                if (count($ids) > 0)
                {
                    $this->removeTestLocations($ids);
                }
                return null;
            }

            $stmt->close();
            $ids[] = $this->db->insert_id;
        }

        return $ids;
    }

    private function removeTestLocations($ids)
    {
        foreach ($ids as $id)
        {
            // TODO: delete created location
        }
    }
}
