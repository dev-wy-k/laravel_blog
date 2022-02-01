<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define("article-delete", function($user, $article){

            if(Auth::user()->role != 0){
                // Admin မဟုတ်ရင် စစ်မယ် 
                return $user->id == $article->user_id ;

            }

            return true ;

        });

        Gate::define("article-edit", function($user, $article){

            if(Auth::user()->role != 0){

                return $user->id == $article->user_id ;
                
            }

            return true ;

        });
    }
}
