<?php

use Illuminate\Database\Seeder;
use App\Purchase;
use App\Offering;

class PurchasesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Offering::class, 10)->create()->each(function ($o) {
            $purchase = factory(Purchase::class)->make();
            $o->purchase()->save($purchase);
        });
    }
}
