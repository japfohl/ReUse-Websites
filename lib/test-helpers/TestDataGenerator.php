<?php

require_once dirname(__FILE__).'/../../vendor/autoload.php';

use Faker\Factory;

class TestDataGenerator
{
    // properties
    protected $faker;
    protected $mysqli;

    // constructor
    public function __construct()
    {
        $this->faker = Factory::create();
        $this->mysqli = connectReuseDB();
    }

    public function generateRandomLocations($num)
    {
        // TODO return array of ids for randomly generated locations
    }

    protected function createRandomLocation()
    {
        // TODO: create and return a random location using Faker
    }
}