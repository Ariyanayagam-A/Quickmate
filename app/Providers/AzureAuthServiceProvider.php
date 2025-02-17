<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use TheNetworg\OAuth2\Client\Provider\Azure;

class AzureAuthServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(Azure::class, function ($app) {
            return new Azure([
                'clientId'          => config('azure.client_id'),
                'clientSecret'      => config('azure.client_secret'),
                'redirectUri'       => config('azure.redirect_uri'),
                'tenant'            => config('azure.tenant_id'),
                'clientCertificatePrivateKey' => config('azure.client_certificate_private_key'),
                'clientCertificateThumbprint' => config('azure.client_certificate_thumbprint'),
                'defaultEndPointVersion' => '2.0'
            ]);
        });
    }

    public function boot()
    {
        //
    }

}
?>