<?php

namespace App\Console\Commands;

use App\Service\BlockService;
use App\Service\EventService;
use App\Service\PlaceService;
use Illuminate\Console\Command;

class MyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:events {number}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create events in the table. Please write the number of events being created';

    /**
     * Execute the console command.
     */
    public function handle(EventService $eventService, BlockService $blockService, PlaceService $placeService): void
    {
        $events = $this->argument('number');
        $blocksABCInEvent = 4;
        $blocksFanzoneInEvent = 1;
        $row = 10;
        $number_in_row = 15;
        $quotaFanzone = 1000;
        $totalBlocksInEvent = $blocksABCInEvent + $blocksFanzoneInEvent;
        $totalBlocks = $events * ($totalBlocksInEvent);
        $fanzoneId [] = $totalBlocks;
        $k = $totalBlocks;
        while ($k > $totalBlocksInEvent) {
            $k = $k - $totalBlocksInEvent;
            $fanzoneId [] = $k;
        };
        $faker = \Faker\Factory::create();
        for ($i = 1; $i <= $events; $i++) {
            $eventService->create('Event' . $i, $faker->city, $faker->dateTimeBetween('now', '+2 years'), $faker->boolean);
            for ($k = 1; $k <= $blocksABCInEvent; $k++) {
                $blockService->create('Block' . $k, $i);
            }
            $blockService->create('Fanzone', $i);
        }
        $this->info('Created success 6 events');
        $this->info('Created success blocks');

        //Places
        $j = 1;
        while ($j <= $totalBlocks) {
            if (in_array($j, $fanzoneId)) {
                $placeService->create($faker->randomFloat(2, 20, 70), 0, $quotaFanzone, $j, 0);
            } else {
                for ($i = 1; $i <= $row; $i++) {
                    for ($k = 1; $k <= $number_in_row; $k++) {
                        $quota = (int)$faker->boolean;
                        $placeService->create($faker->randomFloat(2, 20, 70), $i, $quota, $j, $k);
                    }
                }
            }
            $j = $j + 1;
        }
        $this->info('Created success places');
    }

}
