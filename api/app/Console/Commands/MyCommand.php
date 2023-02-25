<?php

namespace App\Console\Commands;

use App\Service\BlockService;
use App\Service\EventService;
use App\Service\OrderService;
use App\Service\PlaceService;
use App\Service\TicketService;
use Illuminate\Console\Command;

class MyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:objects {table}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new objects in table. You need to write the name of the table as attribute';

    /**
     * Execute the console command.
     */
    public function handle(EventService $eventService,OrderService $orderService, BlockService $blockService, TicketService $ticketService, PlaceService $placeService): void
    {
        $faker = \Faker\Factory::create();
        switch ($this->argument('table')) {

            case 'event':
                for ($i = 1; $i < 6; $i++) {
                    $eventService->create('Event' . $i,$faker->city,$faker->dateTimeBetween('now', '+2 years'),$faker->boolean);
                }
                $this->info('The objects created success in the Events table');
                break;
            case 'block':
                for ($i = 1; $i < 6; $i++) {
                    $blockService->create('Block' . $i, rand(1, 5));
                }
                $this->info('The objects created success in the Blocks table');
                break;
            case 'place':
                $j = 1;
                for ($i = 1; $i < 6; $i++) {
                    for ($k = 1; $k <= 10; $k++) {
                        $quota =(int) $faker->boolean;
                        $placeService->create($faker->randomFloat(2, 20, 70), $i, $quota, $i, $j);
                        $j++;
                    }
                }
                $this->info('The objects created success in the Places table');
                break;
            case 'ticket':
                for ($i = 1; $i <= 50; $i++) {
                    $barcode = $faker->numerify("### ### ###");
                    $ticketService->create($barcode, $i);
                }
                $this->info('The objects created success in the Tickets table');
        }
    }
}
