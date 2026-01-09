<?php

declare(strict_types=1);

namespace SharpAPI\TthReviewSentiment;

use Illuminate\Support\ServiceProvider;

/**
 * @api
 */
class TthReviewSentimentProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/sharpapi-tth-review-sentiment.php' => config_path('sharpapi-tth-review-sentiment.php'),
            ], 'sharpapi-tth-review-sentiment');
        }
    }

    /**
     * Register the application services.
     */
    public function register(): void
    {
        // Merge the package configuration with the app configuration.
        $this->mergeConfigFrom(
            __DIR__.'/../config/sharpapi-tth-review-sentiment.php', 'sharpapi-tth-review-sentiment'
        );
    }
}