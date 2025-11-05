<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;

class ProcessUserJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $criticalStock = rand(0, 10);
        $pendingOrders = rand(0, 50);
        $averageShippingTime = rand(1, 10);
    
        $alerts = collect();
        if ($criticalStock > 5) $alerts->push('Critical stock levels across several products');
        if ($pendingOrders > 30) $alerts->push('Many unshipped orders');
        if ($averageShippingTime > 7) $alerts->push('Shipping delays');

        $alertCount = $alerts->count();

        $classification = match (true) {
            $alertCount === 0 => 'normal',
            $alertCount === 1 => 'warning',
            default => 'critical',
        };

        $result = [
            'user_id' => $this->user->id,
            'alerts_count' => $alertCount,
            'alerts' => $alerts,
            'alert_level' => $classification,
            'date' => now()->toDateTimeString(),
        ];
    
        Cache::put("user_result_{$this->user->id}", $result, now()->addMinutes(2));
    }
}
