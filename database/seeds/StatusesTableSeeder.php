<?php

use Illuminate\Database\Seeder;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list = ['View','In Progress','Done'];
        foreach ($list as $v){
            if(!\App\Models\Status::where('status',$v)->first()){
                factory(\App\Models\Status::class,1)->create(['status'=>$v]);
            }
        }
    }
}
