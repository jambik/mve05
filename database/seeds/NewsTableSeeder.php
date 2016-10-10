<?php

use App\News;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class NewsTableSeeder extends Seeder
{
    protected $items = [
        ['Теперь вы можете узнавать о новых акциях и новостях компании на сайте', '<p>Теперь вы можете узнавать о новых акциях и новостях компании на сайте. На сайте Вы сможете найти полный список всех АЗС принимающих талоны MVE. Так же вы можете оставлять свои пожелания или замечани на странице <a href="/feedback">Обратная связь</a></p>', ''],
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
