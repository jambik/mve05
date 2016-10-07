<?php

use Illuminate\Database\Seeder;
use App\Block;

class BlocksTableSeeder extends Seeder
{
    protected $items = [

        ['header', 'Текст в шапке', '<section id="blocks"><div class="container"><div class="row"><div class="col-md-4"><div class="jumbotron text-center lead">Блок 1</div></div><div class="col-md-4"><div class="jumbotron text-center lead">Блок 2</div></div><div class="col-md-4"><div class="jumbotron text-center lead">Блок 3</div></div></div></div></section>'],
        ['copyright', 'Копирайт', '<p>copyright @ jambik</p>'],

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
            $row = array_combine(['alias', 'title', 'text'], $this->items[$i]);

            Block::create($row);
        }
    }
}
