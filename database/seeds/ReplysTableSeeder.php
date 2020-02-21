<?php

use Illuminate\Database\Seeder;
use App\Models\Reply;
use App\Models\User;
use App\Models\Status;
class ReplysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //所有用户 ID 数组
        $user_ids = User::all()->pluck('id')->toArray();

        //所有微博 ID 数组
        $status_ids = Status::all()->pluck('id')->toArray();

        //获取 Faker 示例
        $faker = app(Faker\Generator::class);

        $replys = factory(Reply::class)
                        ->times(1000)
                        ->make()
                        ->each(function ($reply, $index)
                        use ($user_ids, $status_ids, $faker)
                        {
                            // 从用户 ID 数组中随机取出一个并赋值
                            $reply->user_id = $faker->randomElement($user_ids);

                            // 微博 ID，同上
                            $reply->status_id = $faker->randomElement($status_ids);
                        });

        // 将数据集合转换为数组，并插入到数据库中
        Reply::insert($replys->toArray());

    }
}
