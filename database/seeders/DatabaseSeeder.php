<?php

namespace Database\Seeders;



//use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\product;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // User::factory(10)->withPersonalTeam()->create();
        $categories =[
            ['id'=>1,'name'=> 'الاكترونيات','description'=>'','imagepath'=>'assets\img\ha.jpg'],
            ['id'=>2,'name'=> 'ماكولات','description'=>'ماكولات شعبية','imagepath'=>'assets\img\sa.jpg'],
            ['id'=>3,'name'=> 'كاميرات','description'=>'كاميرات HD','imagepath'=>'assets\img\no.webp'],
            ['id'=>4,'name'=> 'الالعاب','description'=>'الالعاب ps5','imagepath'=>'assets\img\ha.jpg'],


        ];

        DB::table('categories')->insertOrIgnore($categories);

        for ($i = 1; $i <= 10; $i++) {
            Product::create([
                'name'=> 'product'. $i,
                'description' => 'this is'.$i,
                'price'=> rand(10,100),
                'quantity'=> rand(1,50),
                'imagepath'=> '',
                'category_id'=> rand(1,4),

                ]);

        }
       // User::factory()->withPersonalTeam()->create([
            //'name' => 'Test User',
            //'email' => 'test@example.com',
       // ]);
    }
}
