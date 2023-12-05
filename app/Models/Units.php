<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Units extends Model
{
    use HasFactory;

    public static function pkLevel($value, $view = 0): string
    {
        $pkLevels = [
            0 => ['Hero'],
            1 => ['Commoner'],
            2 => ['Normal'],
            3 => ['Against Murderer'],
            4 => ['Murderer'],
            5 => ['Phonomania']
        ];

        return $pkLevels[$value][$view] ?? 'Unknown';
    }

    public static function getClassMappings()
    {
        return [
            'sm' => [0, 1, 3, 7],
            'bk' => [16, 18, 17, 19, 23],
            'elf' => [32, 33, 35, 39],
            'mg' => [48, 50, 54],
            'dl' => [64, 66, 70],
            'sum' => [80, 81, 82, 83, 87],
            'rf' => [96, 98, 102],
        ];
    }

    public static function getClassIcons()
    {
        return [
            'sm' => 'sm-icon.png',
            'bk' => 'bk-icon.png',
            'elf' => 'elf-icon.png',
            'mg' => 'mg-icon.png',
            'dl' => 'dl-icon.png',
            'sum' => 'sum-icon.png',
            'rf' => 'rf-icon.png',
        ];
    }

    public static function getClassIconUrl($class)
    {
        $icons = self::getClassIcons();
        return url('/images/' . $icons[$class]);
    }

    public static function generateCharacterTop5Row($index, $character)
    {
        $classMappings = self::getClassMappings();

        $classIcon = '';
        foreach ($classMappings as $background => $classArray) {
            if (in_array($character->Class, $classArray)) {
                $classIcon = "<img src='" . self::getClassIconUrl($background) . "' alt=''>";
                break;
            }
        }

        $row = '<tr>' .
            ' <td>' . ++$index . '</td>' .
            '<td><a href="/user/' . $character->Name . '">' . $character->Name . '</a></td>' .
            '<td>' . $classIcon . '</td>' .
            '<td>' . $character->Resets . '</td>' .
            '</tr>';

        return $row;
    }

    public static function generateCharacterRow($index, $character)
    {
        $classMappings = self::getClassMappings();
        $guild = GuildMember::getGuildByUsername($character->Name);
        $guildName = $guild ? $guild->G_Name : 'No Guild';

        $classIcon = '';
        foreach ($classMappings as $background => $classArray) {
            if (in_array($character->Class, $classArray)) {
                $classIcon = "<img src='" . self::getClassIconUrl($background) . "' alt=''>";
                break;
            }
        }

        $row = '<tr>' .
            ' <td>' . ++$index . '</td>' .
            '<td><a href="/user/' . $character->Name . '">' . $character->Name . '</a></td>' .
            '<td>' . $classIcon . '</td>' .
            '<td>' . $guildName . ' </td>' .
            '<td>' . $character->Resets . '</td>' .
            '</tr>';

        return $row;
    }

    public static function generateGuildRow($index, $guild)
    {
        $row = '<tr>' .
            ' <td>' . ++$index . '</td>' .
            '<td>' . $guild->G_Name . '</td>' .
            '<td>' . $guild->G_Master . '</td>' .
            '<td>' . $guild->Resets . '</td>' .
            '</tr>';

        return $row;
    }

    public static function generateCharacterPanel($index, $character)
    {
        $classMappings = self::getClassMappings();

        $classIcon = '';
        foreach ($classMappings as $background => $classArray) {
            if (in_array($character->Class, $classArray)) {
                $classIcon = "<img src='" . self::getClassIconUrl($background) . "' alt=''>";
                break;
            }
        }

        $row = '<tr>' .
            ' <td rowspan="2">' . ++$index . '</td>' .
            '<td rowspan="1">' . $character->Name . '</td>' .
            '<td rowspan="2">' . $classIcon . '</td>' .
            '<td>' . $character->cLevel . '</td>' .
            '<td>' . $character->Resets . '</td>' .
            '<td>' . $character->Strength . '</td>' .
            '<td>' . $character->Dexterity . '</td>' .
            '<td>' . $character->Vitality . '</td>' .
            '<td>' . $character->Energy . '</td>' .
            '<td>' . $character->PkCount . '</td>' .
            '</tr>' .

            '<tr>' .
            '<td rowspan="1">' . self::pkLevel($character->PkLevel) . '</td>' .
            '<td colspan="8">Created ' . date('d/m/Y H:i', strtotime($character->MDate)) . '</td>' .
            '</tr>';

        return $row;
    }
}
