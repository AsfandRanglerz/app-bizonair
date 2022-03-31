<?php

use Illuminate\Database\Seeder;

class FirebaseTokenTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('firebase_tokens')->delete();

        \DB::table('firebase_tokens')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'user_id' => 1,
                    'device_token' => 'Ye4oKozEa3Ro9llC',
                    'notification' => 5,
                    'created_at' => '2020-03-20 19:16:09',
                    'updated_at' => '2020-03-20 19:16:09',
                ),
            1 =>
                array (
                    'id' => 2,
                    'user_id' => 2,
                    'device_token' => 'Ye4oKoExa3Ro9llC',
                    'notification' => 6,
                    'created_at' => '2020-03-20 19:16:09',
                    'updated_at' => '2020-03-20 19:16:09',
                ),
            2 =>
                array (
                    'id' => 3,
                    'user_id' => 3,
                    'device_token' => 'Ye4oKoEca3Ro9llC',
                    'notification' => 4,
                    'created_at' => '2020-03-20 19:16:09',
                    'updated_at' => '2020-03-20 19:16:09',
                ),
            3 =>
                array (
                    'id' => 4,
                    'user_id' => 7,
                    'device_token' => 'Ye4oKovEa3Ro9llC',
                    'notification' => 8,
                    'created_at' => '2020-03-20 19:16:09',
                    'updated_at' => '2020-03-20 19:16:09',
                ),
            4 =>
                array (
                    'id' => 5,
                    'user_id' => 9,
                    'device_token' => 'Ye4oKoEa3Ro9llC',
                    'notification' => 15,
                    'created_at' => '2020-03-20 19:16:09',
                    'updated_at' => '2020-03-20 19:16:09',
                ),
            5 =>
                array (
                    'id' => 6,
                    'user_id' => 11,
                    'device_token' => 'Ye4oKobEa3Ro9llC',
                    'notification' => 52,
                    'created_at' => '2020-03-20 19:16:09',
                    'updated_at' => '2020-03-20 19:16:09',
                ),
            6 =>
                array (
                    'id' => 7,
                    'user_id' => 21,
                    'device_token' => 'Ye4oKonEa3Ro9llC',
                    'notification' => 14,
                    'created_at' => '2020-03-20 19:16:09',
                    'updated_at' => '2020-03-20 19:16:09',
                ),
            7 =>
                array (
                    'id' => 8,
                    'user_id' => 12,
                    'device_token' => 'Ye4oKojEa3Ro9llC',
                    'notification' => 12,
                    'created_at' => '2020-03-20 19:16:09',
                    'updated_at' => '2020-03-20 19:16:09',
                ),
            8 =>
                array (
                    'id' => 9,
                    'user_id' => 16,
                    'device_token' => 'Ye4oKohEa3Ro9llC',
                    'notification' => 17,
                    'created_at' => '2020-03-20 19:16:09',
                    'updated_at' => '2020-03-20 19:16:09',
                ),
            9 =>
                array (
                    'id' => 10,
                    'user_id' => 18,
                    'device_token' => 'Ye4oKoEga3Ro9llC',
                    'notification' => 5,
                    'created_at' => '2020-03-20 19:16:09',
                    'updated_at' => '2020-03-20 19:16:09',
                ),
            10 =>
                array (
                    'id' => 11,
                    'user_id' => 19,
                    'device_token' => 'Ye4oKoEda3Ro9llC',
                    'notification' => 53,
                    'created_at' => '2020-03-20 19:16:09',
                    'updated_at' => '2020-03-20 19:16:09',
                ),


        ));
    }
}
