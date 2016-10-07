<?php

use App\News;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class NewsTableSeeder extends Seeder
{
    protected $items = [

    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0, $iMax=count($this->items); $i<$iMax; $i++)
        {
            $row = array_combine(['title', 'text', 'image'], $this->items[$i]) + ['published_at' => Carbon::now()];

            News::create($row);
        }
    }
}
