<?php

namespace App\Jobs;

use App\Models\Client;
use DateInterval;
use DateTime;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CalculateDaysToBirthday implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @return void
     * @throws \Exception
     */
    public function handle(): void
    {
        $clients = Client::all();

        foreach ($clients as $client) {
            $currentDate = new DateTime();
            $birthdayDate = new DateTime($client->born_on);
            $birthdayDate->setDate($currentDate->format("Y"), $birthdayDate->format("m"), $birthdayDate->format("d"));
            if ($birthdayDate < $currentDate) {
                $birthdayDate->add(new DateInterval("P1Y"));
            }
            $interval = $currentDate->diff($birthdayDate);
            $client->update(['day_to_birthday' => $interval->days]);
        }
    }
}
