<?php

use App\Azs;
use Illuminate\Database\Seeder;

class AzsTableSeeder extends Seeder
{
    protected $items = [
        ['АЗС «Ликойл»', 'центральный офис', 'г. Махачкала', 'пр. А.Акушинского, 34«а»', '42.980997', '47.457038'],
        ['АЗС «Ликойл»', '', 'г. Махачкала', 'пр. А.Акушинского поворот на больницу на Горке', '42.97749', '47.44588'],
        ['АЗС «Ликойл»', '', 'г. Махачкала', 'пр. А.Акушинского, 106«а» поворот с Семендера', '42.97006', '47.41014'],
        ['АЗС «Согрнефть»', '', 'г. Махачкала', 'район Черных Камней после поста вторая', '43.02962', '47.4466'],
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
            $row = array_combine(['name', 'description', 'location', 'address', 'lat', 'lng'], $this->items[$i]);

            Azs::create($row);
        }
    }
}
