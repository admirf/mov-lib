<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SetPassportTokens extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('oauth_clients')
            ->where('id', config('app.password_grant.client'))
            ->update(['secret' => config('app.password_grant.secret')]);
    }
}
