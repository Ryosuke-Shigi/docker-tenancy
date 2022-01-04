<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Hyn\Tenancy\Models\Hostname;
use Hyn\Tenancy\Contracts\Repositories\HostnameRepository;
use Hyn\Tenancy\Models\Website;
use Hyn\Tenancy\Contracts\Repositories\WebsiteRepository;

//テナント作成ページ
Route::get('create_tenant',function(){

    //web作成
	$website = new Website;
	app(WebsiteRepository::class)->create($website);

    //ホスト作成
	$hostname = new Hostname;
	$hostname->fqdn = 'first.localhost';
	$hostname = app(HostnameRepository::class)->create($hostname);
	app(HostnameRepository::class)->attach($hostname, $website);

	return redirect('/');

});



Route::get('/', function () {
    return view('welcome');
});
