<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class UserManagementService
{
    protected $baseUrl;

    /**
     * @param $baseUrl
     */
    public function __construct($baseUrl)
    {
        $this->baseUrl = config("services.usermgmt.base_uri");
    }

    public function createUser(array $data){
        try {
            $response = Http::timeout(15)->post($this->baseUrl.'/api/user', $data);
            return $response->json();
        }catch (\Exception $e){
            Log::error('User service error: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'User service unavailable',
                'data' => null
            ];
        }
    }

    public function getUser($id){
        return Cache::driver("")->remember("user-{$id}", now()->addMinute(30), function() use($id){
            try {
                $response = Http::get($this->baseUrl.'/api/user/'.$id);
                return $response->json();
           } catch (\Exception $e) {
                Log::error('User service error: ' . $e->getMessage());
                return null;

            }
        });
    }


}
