<?php

namespace App\Metrics;

use App\Influx\Metrics;

class Group {

    public $total;
    public $servers;

    public function __construct($obj,$interval = "1m") {
        if(get_class($obj) == 'App\Group') {
            return $this->getGroupMetrics($obj,$interval);
        } elseif (get_class($obj) == 'App\User') {
            return $this->getUserMetrics($obj,$interval);
        } else {
            throw new \Exception("Error, Metrics\Group need an user or group class");
        }
    }

    private function getGroupMetrics(\App\Group $group,$interval) {

        $this->total = new \stdClass();
        $this->total->storage = array("used" => 0,"total" => 0,"percent" => 0);
        $this->total->bandwidth = array("avg" => 0, "max" => 0,"percent" =>0);
        $this->total->memory = array("total" => 0, "used" => 0,"percent" =>0);

        $this->servers = $group->servers()->get();
        $influx = new Metrics();

        $tmp_server = [];

        foreach($this->servers as $server) {

            $this->total->memory["total"] += $influx->getTotalMemory($server->hash);
            $this->total->memory["used"] += $influx->getUsedMemory($server->hash);
            $this->total->memory["percent"] = floor($this->total->memory["used"] / $this->total->memory["total"] * 100);

            $this->total->bandwidth["avg"] += $influx->getAvgBandwidth($server->hash);
            $this->total->bandwidth["max"] += $influx->getMaxBandwidth($server->hash);

            $this->total->storage["total"] += $influx->getTotalStorage($server->hash);
            $this->total->storage["used"] += $influx->getUsedStorage($server->hash);
            $this->total->storage["percent"] = floor($this->total->storage["used"] / $this->total->storage["total"] * 100);

            $_server = new \stdClass();
            $_server->name = $server->name;
            $_server->system = $server->system;
            $_server->os = $server->os;
            $_server->hash = $server->hash;
            $_server->agent_connected = $server->agent_connected;

            $_server->summary = array();
            $_server->summary["cpu"] = $influx->getCpuSummary($server->hash);
            $_server->summary["memory"] = $influx->getMemorySummary($server->hash);
            $_server->summary["storage"] = $influx->getStorageSummary($server->hash);

            $tmp_server[] = $_server;

        }

        $this->servers = $tmp_server;

        return $this;

    }
    private function getUserMetrics(\App\Group $group) {

    }

}