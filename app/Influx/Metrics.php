<?php

namespace App\Influx;

class Metrics {

    private $database;
    public function __construct() {
        $client = new \InfluxDB\Client("localhost");
        $this->database = $client->selectDB('mesurements');
    }

    public function getTotalMemory($hash) {
        $result = $this->database->query('SELECT * FROM MemoryTotal WHERE hash = \''.$hash.'\' ORDER BY DESC LIMIT 1');
        if(isset($result->getPoints()[0]["value"])) {
            return $result->getPoints()[0]["value"];
        }
        return 0;
    }

    public function getUsedMemory($hash) {
        $result = $this->database->query('SELECT * FROM MemoryUsed WHERE hash = \''.$hash.'\' ORDER BY DESC LIMIT 1');
        if(isset($result->getPoints()[0]["value"])) {
            return $result->getPoints()[0]["value"];
        }
        return 0;
    }

    public function getAvgBandwidth($hash) {
        return 1024*1024;
    }
    public function getMaxBandwidth($hash) {
        return 1024*1024*1.2;
    }

    public function getTotalStorage($hash) {
        return 1024*1024;
    }
    public function getUsedStorage($hash) {
        return 1024*1024*1.2;
    }

    public function getCpuSummary($hash,$interval = "5m") {
        $result = $this->database->query('SELECT mean(value) FROM CpuCurrentLoad WHERE hash = \''.$hash.'\' AND time > NOW() - 1h GROUP BY time('.$interval.') ORDER BY DESC LIMIT 1');

        if(isset($result->getPoints()[0]["mean"])) {
            return round($result->getPoints()[0]["mean"]);
        }
        return "X";
    }

    public function getMemorySummary($hash,$interval = "5m") {
        $result = $this->database->query('SELECT * FROM MemoryTotal WHERE hash = \''.$hash.'\' ORDER BY DESC LIMIT 1');

        if(isset($result->getPoints()[0]["value"])) {
            $total = $result->getPoints()[0]["value"];

            $result = $this->database->query('SELECT * FROM MemoryUsed WHERE hash = \''.$hash.'\' ORDER BY DESC LIMIT 1');
            if(isset($result->getPoints()[0]["value"])) {
                $used = $result->getPoints()[0]["value"];
                return round($used/$total*100,2);
            }

        }
        return "X";
    }

    public function getStorageSummary($hash,$interval = "5m") {
        $result = $this->database->query('SELECT * FROM FsSizeSize WHERE hash = \''.$hash.'\' ORDER BY DESC LIMIT 1');

        if(isset($result->getPoints()[0]["value"])) {
            $total = $result->getPoints()[0]["value"];

            $result = $this->database->query('SELECT * FROM FsSizeUse WHERE hash = \''.$hash.'\' ORDER BY DESC LIMIT 1');
            if(isset($result->getPoints()[0]["value"])) {
                $used = $result->getPoints()[0]["value"];
                return round($used/$total*100,2);
            }

        }
        return "X";
    }

}