<?php


namespace MMunoz;

define("VOCATION_KNIGHT", "Knight");
define("VOCATION_ELITE_KNIGHT", "Elite Knight");
define("VOCATION_DRUID", "Druid");
define("VOCATION_ELDER_DRUID", "Elder Druid");
define("VOCATION_SORCERER", "Sorcerer");
define("VOCATION_MASTER_SORCERER", "Master Sorcerer");
define("VOCATION_PALADIN", "Paladin");
define("VOCATION_ROYAL_PALADIN", "Royal Paladin");

class Tibia
{

    /**
     * Tibia constructor.
     * @param $world
     */
    public function __construct()
    {
    }

    /**
     * @param $world
     * @return World
     */
    private function getWorld($world) {
        $data = file_get_contents("https://api.tibiadata.com/v2/world/{$world}.json");
        $json = json_decode($data, true);
        return (new World())->setData($json['world']);
    }

    /**
     * @param $name
     * @return bool|Player
     */
    public function getPlayer($name) {
        $name = urlencode($name);
        $data = file_get_contents("https://api.tibiadata.com/v2/characters/$name.json");
        $json = json_decode($data, true);
        return (new Player())->setData($json['characters']['data']);
    }

    public function isShared($level, $party) {

    }

    /**
     * @param $player Player
     * @param bool $onlyPremium
     */
    public function lookForTeamHunt($player, $onlyPremium = false) {
        $world = $this->getWorld($player->world);

        $party = new Party();
        $party->addMember($player);

        $res = [];

        foreach ($world->players_online_data as $playerData) {
            $p = (new Player())->setData($playerData);
            if($party->isShared($p) && (!$onlyPremium || $p->isPremium())) {
                $res[] = $p;
            }
        }

        usort($res, function($p1, $p2) { return strcmp($p2->vocation, $p1->vocation); });

        foreach ($res as $item) {
            echo $this->shortVocation($item->vocation) . " " . $item->name . " " . $item->level . "\n";
        }
    }

    public function shortVocation($longVocationName) {
        switch ($longVocationName) {
            case VOCATION_ELITE_KNIGHT:
                return "EK";
            case VOCATION_KNIGHT:
                return "K";
            case VOCATION_ELDER_DRUID:
                return "ED";
            case VOCATION_DRUID:
                return "D";
            case VOCATION_MASTER_SORCERER:
                return "MS";
            case VOCATION_SORCERER:
                return "S";
            case VOCATION_ROYAL_PALADIN:
                return "RP";
            case VOCATION_PALADIN:
                return "P";
        }
        return "";
    }
}