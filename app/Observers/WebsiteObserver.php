<?php

namespace App\Observers;

use App\Models\Website;
use Illuminate\Support\Facades\DB;

class WebsiteObserver
{
    /**
     * Handle the Website "created" event.
     */
    public function created(Website $website): void
    {
        $this->calculatePercent($website);
    }

    /**
     * Handle the Website "updated" event.
     */
    public function updated(Website $website): void
    {
        $this->calculatePercent($website);
    }

    /**
     * Handle the Website "deleted" event.
     */
    public function deleted(Website $website): void
    {
        //
    }

    /**
     * Handle the Website "restored" event.
     */
    public function restored(Website $website): void
    {
        $this->calculatePercent($website);
    }

    /**
     * Handle the Website "force deleted" event.
     */
    public function forceDeleted(Website $website): void
    {
        //
    }

    /**
     * @param Website $website
     * @return void
     */
    public function calculatePercent(Website $website): void
    {
        $websitesInGroup = Website::where('website_group_id', $website->website_group_id)->get();

        $totalPercentage = $websitesInGroup->sum('percentage');
        if ($totalPercentage > 100) {
            $correctionFactor = 100 / $totalPercentage;

            foreach ($websitesInGroup as $existingWebsite) {
                $newPercentage = round($existingWebsite->percentage * $correctionFactor, 3);
                DB::table('websites')
                    ->where('id', $existingWebsite->id)
                    ->update([
                        'percentage' => $newPercentage,
                    ]);
            }
        }
    }
}
