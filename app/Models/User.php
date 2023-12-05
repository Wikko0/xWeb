<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class User extends Model
{
    use HasFactory;

    public static function class($user){
        switch ($user) {
            case 0:
                return 'Dark Wizard';
            case 1:
                return 'Soul Master';
            case 3:
                return 'Grand Master';
            case 7:
                return 'Soul Wizard';

            case 16:
                return 'Dark Knight';
            case 17:
            case 18:
                return 'Blade Knight';
            case 19:
                return 'Blade Master';
            case 23:
                return 'Dragon Knight';

            case 32:
                return 'Fairy Elf';
            case 33:
                return 'Muse Elf';
            case 35:
                return 'High Elf';
            case 39:
                return 'Noble Elf';

            case 48:
                return 'Magic Gladiator';
            case 50:
                return 'Duel Master';
            case 54:
                return 'Magic Knight';

            case 64:
                return 'Dark Lord';
            case 66:
                return 'Lord Emperor';
            case 70:
                return 'Empire Lord';

            case 80:
                return 'Summoner';
            case 81:
            case 82:
                return 'Bloody Summoner';
            case 83:
                return 'Dimension Master';
            case 87:
                return 'Dimension Summoner';

            case 96:
                return 'Rage Fighter';
            case 98:
                return 'Fist Master';
            case 102:
                return 'Fist Blazer';

            case 112:
                return 'Grow Lancer';
            case 114:
                return 'Mirage Lancer';
            case 118:
                return 'Shining Lancer';
        }

    }

    public static function getStatus($user): string
    {
        $id = Character::findByName($user);
        $check = MEMB_STAT::findByAccountId($id->AccountID);
        $check2 = DB::table('AccountCharacter')->where('id', '=', $id->AccountID)->first();

        if ($check && ($check->ConnectStat >= 1 || $check2->GameIDC == $user)) {
            return 'Online';
        }

        return 'Offline';
    }

    public static function map($value): string
    {
        $map = array(
            0 => 'Lorencia',
            1 => 'Dungeon',
            2 => 'Devias',
            3 => 'Noria',
            4 => 'Lost Tower',
            6 => 'Arena',
            7 => 'Atlans',
            8 => 'Tarkan',
            9 => 'Devil Square',
            10 => 'Icarus',
            11 => 'Blood Castle',
            12 => 'Blood Castle',
            13 => 'Blood Castle',
            14 => 'Blood Castle',
            15 => 'Blood Castle',
            16 => 'Blood Castle',
            17 => 'Blood Castle',
            18 => 'Chaos Castle',
            19 => 'Chaos Castle',
            20 => 'Chaos Castle',
            21 => 'Chaos Castle',
            22 => 'Chaos Castle',
            23 => 'Chaos Castle',
            24 => 'Kalima 1',
            25 => 'Kalima 2',
            26 => 'Kalima 3',
            27 => 'Kalima 4',
            28 => 'Kalima 5',
            29 => 'Kalima 6',
            30 => 'Valley of Loren',
            31 => 'Land of Trials',
            32 => 'Devil Square',
            33 => 'Aida',
            34 => 'Crywolf Fortress',
            36 => 'Kalima 7',
            37 => 'Kanturu',
            38 => 'Kanturu',
            39 => 'Kanturu',
            40 => 'Silent Map',
            41 => 'Balgass Barracks',
            42 => 'Balgass Refuge',
            45 => 'Illusion Temple',
            46 => 'Illusion Temple',
            47 => 'Illusion Temple',
            48 => 'Illusion Temple',
            49 => 'Illusion Temple',
            50 => 'Illusion Temple',
            51 => 'Elbeland',
            52 => 'Blood Castle',
            53 => 'Chaos Castle',
            56 => 'Swamp of Calmness',
            57 => 'Raklion',
            58 => 'Raklion Boss',
            62 => 'Santa\'s Village',
            63 => 'Vulcanus',
            64 => 'Duel Arena',
            65 => 'Doppelganger',
            66 => 'Doppelganger',
            67 => 'Doppelganger',
            68 => 'Doppelganger',
            69 => 'Imperial Guardian',
            70 => 'Imperial Guardian',
            71 => 'Imperial Guardian',
            72 => 'Imperial Guardian',
            79 => 'Loren Market',
            80 => 'Karutan 1',
            81 => 'Karutan 2',
            82 => 'Doppelganger',
            91 => 'Acheron',
            92 => 'Acheron',
            95 => 'Debenter',
            96 => 'Debenter',
            97 => 'Chaos Castle',
            98 => 'Ilusion Temple',
            99 => 'Ilusion Temple',
            100 => 'Uruk Mountain',
            101 => 'Uruk Mountain',
            102 => 'Tormented Square',
            103 => 'Tormented Square',
            104 => 'Tormented Square',
            105 => 'Tormented Square',
            106 => 'Tormented Square',
            110 => 'Nars',
            112 => 'Ferea',
            113 => 'Nixie Lake',
            114 => 'Quest Zone',
            115 => 'Labyrinth',
            116 => 'Deep Dungeon',
            117 => 'Deep Dungeon',
            118 => 'Deep Dungeon',
            119 => 'Deep Dungeon',
            120 => 'Deep Dungeon',
            121 => 'Quest Zone',
            122 => 'Swamp of Darkness',
            123 => 'Kubera Mine',
            124 => 'Kubera Mine',
            125 => 'Kubera Mine',
            126 => 'Kubera Mine',
            127 => 'Kubera Mine',
            128 => 'Atlans Abyss',
            129 => 'Atlans Abyss 2',
            130 => 'Atlans Abyss 3',
            131 => 'Scorched Canyon',
            132 => 'Crimson Flame Icarus',
            133 => 'Temple of Arnil',
            134 => 'Aida Gray',
            135 => 'Old Kethotum',
            136 => 'Burning Kethotum',
        );

        return $map[$value] ?? "----";

    }

    public static function background($class): string
    {
        $classMappings = [
            "sm" => [0, 1, 3, 7],
            "bk" => [16, 17, 19, 23],
            "elf" => [32, 33, 35, 39],
            "mg" => [48, 50, 54],
            "dl" => [64, 66, 70],
            "sum" => [80, 81, 83, 87],
            "rf" => [96, 98, 102],
            "gl" => [112, 114, 118],
        ];

        foreach ($classMappings as $background => $classArray) {
            if (in_array($class, $classArray)) {
                return "class-" . $background;
            }
        }

        return "";
    }


}
