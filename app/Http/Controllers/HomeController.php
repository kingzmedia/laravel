<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \InfluxDB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client = new \InfluxDB\Client("localhost", 8086);
        $database = $client->selectDB('influx_test_db');
        $result = $database->query('select * from test_metric LIMIT 5');

// get the points from the resultset yields an array
        $points = $result->getPoints();

        dump($points);
/*
        $points = array(
            new \InfluxDB\Point(
                'test_metric', // name of the measurement
                0.64, // the measurement value
                ['host' => 'server01', 'region' => 'us-west'], // optional tags
                ['cpucount' => 10], // optional additional fields
                1435255849 // Time precision has to be set to seconds!
            ),
            new \InfluxDB\Point(
                'test_metric', // name of the measurement
                0.84, // the measurement value
                ['host' => 'server01', 'region' => 'us-west'], // optional tags
                ['cpucount' => 10], // optional additional fields
                1435255849 // Time precision has to be set to seconds!
            )
        );

// we are writing unix timestamps, which have a second precision
        $result = $database->writePoints($points, \InfluxDB\Database::PRECISION_SECONDS);
*/
        die("ok");
        return view('home');
    }
}
