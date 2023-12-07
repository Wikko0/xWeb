<?php

namespace App\Helpers;

class EventHelper
{
    public static function updateEvents($request, $configFile): void
    {
        /* Validation */
        $request->validate([
            'everyday' => ['nullable'],
            'monday' => ['nullable'],
            'tuesday' => ['nullable'],
            'wednesday' => ['nullable'],
            'thursday' => ['nullable'],
            'friday' => ['nullable'],
            'saturday' => ['nullable'],
            'sunday' => ['nullable'],
        ]);

        /* Decode */
        $decode = json_decode(file_get_contents(storage_path() . "/app/public/" . $configFile), true);

        foreach ($decode['events']['event_timers'] as $value) {
            $name = $request->event;
            $days = $request->days;

            if (in_array(0, $days)) {
                $days = 0;
            }

            if ($days == 0) {
                $time = $request->everyday;
            }

            if (!is_array($days)) {
                $config = ['name' => $name, 'days' => $time];
            } else {
                $d = [];

                foreach ($days as $key => $values) {
                    switch ($values) {
                        case 1:
                            $d[$values] = $request->monday;
                            break;
                        case 2:
                            $d[$values] = $request->tuesday;
                            break;
                        case 3:
                            $d[$values] = $request->wednesday;
                            break;
                        case 4:
                            $d[$values] = $request->thursday;
                            break;
                        case 5:
                            $d[$values] = $request->friday;
                            break;
                        case 6:
                            $d[$values] = $request->saturday;
                            break;
                        case 7:
                            $d[$values] = $request->sunday;
                            break;
                        default:
                            break;
                    }
                }

                $config = ['name' => $name, 'days' => $d];
            }
        }

        array_push($decode['events']['event_timers'], $config);
        $newJsonString = json_encode($decode);
        file_put_contents(storage_path() . "/app/public/" . $configFile, $newJsonString);
    }

    public static function deleteEvents($eventName, $configFile): void
    {
        /* Decode */
        $decode = json_decode(file_get_contents(storage_path() . "/app/public/" . $configFile), true);

        foreach ($decode['events']['event_timers'] as $key => $element) {
            if ($eventName == $element['name']) {
                unset($decode['events']['event_timers'][$key]);
            }
        }

        /* Delete */
        $newJsonString = json_encode($decode);
        file_put_contents(storage_path() . "/app/public/" . $configFile, $newJsonString);
    }
}
