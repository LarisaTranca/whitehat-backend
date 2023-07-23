<?php

namespace App\Providers;

use App\Helpers\Helper;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Support\ServiceProvider;

class ApiResponseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $response = app(ResponseFactory::class);

        $response->macro('success', function (int $responseCode = 200, string $code = 'OK', $data = null) use ($response) {

            return $response->json(Helper::buildResponseObject('success', $code, 'data', $data), $responseCode);
        });

        $response->macro('error', function (int $responseCode = 500, string $code = 'Failed', $errors) use ($response) {

            if (is_string($errors)) {
                return $response->json(Helper::buildResponseObject('fail', $code, 'errors', [$errors]), $responseCode);
            }

            $flatten = [];
            array_walk_recursive($errors, function ($error) use (&$flatten) {
                $flatten[] = $error;
            });

            return $response->json(Helper::buildResponseObject('fail', $code, 'errors', $flatten), $responseCode);
        });

    }

}
