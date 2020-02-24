<?php namespace App\Models;

use DB;
use App\Exceptions\AccountException;

/**
 * Class Account
 * @package App\Models
 *
 * Placeholder for eventual Account model with db persistence
 */
class Account
{

    protected $attributes;

    public function __construct($slug)
    {
        $this->attributes = config("accounts.$slug");
        // If account exists
        if($this->exists()){
            // Continue setup
            $this->attributes['slug'] = $slug;
            $this->setupConnection();
        }
    }

    protected function setupConnection(){
        // Make sure we change to the proper database
        if(!isset($this->connection)){
            throw new AccountException('Account connection is not properly configured [001].');
        }
        config()->set('database.connections.app', $this->connection);
//        dd(config('database.connections.app'));
        DB::connection('app')->reconnect();
    }

    public function exists()
    {
        return !empty($this->attributes);
    }

    public function active()
    {
        return $this->active;
    }

    public function url()
    {
        return 'https://' . $this->slug . '.peoplesbudget.com';
    }

    public function assetPath($asset)
    {
        return '/assets/account/'.$this->slug.'/' . $asset;
    }

    public function logoImg()
    {
        return $this->assetPath($this->theme['logo-img']);
    }

    public function bannerImg()
    {
        return $this->assetPath($this->theme['banner-img']);
    }

    public function __get($name)
    {
        return $this->attributes[$name];
    }

    public function __isset($name)
    {
        return isset($this->attributes[$name]);
    }

}