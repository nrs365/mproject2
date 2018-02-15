<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('ClientsTableSeeder');
        $this->command->info('Clients table seeded!');
	}
}

class ClientsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('clients')->delete();

        Client::create(array('company_name' => 'Sony'));
        Client::create(array('company_name' => 'Microsoft'));
        Client::create(array('company_name' => '3M'));
        Client::create(array('company_name' => 'Apple'));
        Client::create(array('company_name' => 'Google'));
        Client::create(array('company_name' => 'Fender'));
        Client::create(array('company_name' => 'Casio'));
        Client::create(array('company_name' => 'Boss'));
    }

}

