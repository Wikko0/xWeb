<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class EventProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $eventConfigPath = storage_path("app/public/event_config.json");
        $bossConfigPath = storage_path("app/public/boss_config.json");

        if (file_exists($eventConfigPath) && file_exists($bossConfigPath)) {
            $eventProvider = json_decode(file_get_contents($eventConfigPath), true);
            $bossProvider = json_decode(file_get_contents($bossConfigPath), true);

            View::share([
                'eventProvider' => $eventProvider,
                'bossProvider' => $bossProvider,
            ]);
        }

        $this->processTimers($eventConfigPath, 'eventTimerProvider', 'event_config.json');
        $this->processTimers($bossConfigPath, 'bossTimerProvider', 'boss_config.json');
    }

    private function processTimers($configPath, $timerKey, $configFileName)
    {
        $events = json_decode(file_get_contents($configPath), true);
        $days = [1 => 'Monday', 2 => 'Tuesday', 3 => 'Wednesday', 4 => 'Thursday', 5 => 'Friday', 6 => 'Saturday', 7 => 'Sunday'];
        $timers = [];
        $ii = 0;
        $iii = 1;

        foreach ($events['events']['event_timers'] as $event) {
            $name = $event['name'];
            $eventDays = is_array($event['days']) ? $event['days'] : [$event['days']];
            $today = date('N');
            $day = '';

            foreach ($eventDays as $eventDay) {
                if (is_array($eventDay)) {
                    if (isset($eventDay[$today])) {
                        $day = $this->getDayString($today, $eventDay, $days, $configFileName);
                        $times = array_unique(explode(',', $eventDay[$today]));
                    } else {
                        $nextDay = $this->find_next_day($eventDay);
                        $day = 'Next ' . $days[$nextDay];
                        $times = array_unique(explode(',', $eventDay[$nextDay]));
                    }
                } else {
                    $times = array_unique(explode(',', $eventDay));
                    if (!$this->no_more_event($eventDay, time())) {
                        $day = "Tomorrow ";
                    } else {
                        $day = "Today ";
                    }
                }

                asort($times);

                foreach ($times as $t) {
                    $nextTime = strtotime($day . ' ' . $t);
                    if (time() <= $nextTime) {
                        $timeLeft = $nextTime - time();
                        $timers[$ii] = ['name' => $name, 'left' => $timeLeft, 'id' => $iii];
                        $ii++;
                        $iii++;
                        break 2;
                    }
                }
            }
        }

        View::share([$timerKey => $timers]);
    }

    private function no_more_event($times, $now): bool
    {
        $times = explode(',', $times);
        $lastEvent = strtotime('Today ' . end($times));
        return $lastEvent >= $now;
    }

    private function find_next_day($event): int
    {
        $today = date('N');
        $nextDay = $today;
        foreach ($event as $day => $value) {
            if ($day != $today && $day > $today) {
                $nextDay = $day;
                break;
            }
        }
        return $nextDay;
    }

    private function getDayString($today, $eventDay, $days, $configFileName): string
    {
        $day = '';
        foreach ($eventDay as $key => $value) {
            if ($key == $today) {
                $day = "Today ";
                break;
            }
        }

        if ($day === '') {
            $nextDay = $this->find_next_day($eventDay);
            $day = 'Next ' . $days[$nextDay];
        }

        return $day;
    }
}
