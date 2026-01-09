<?php

declare(strict_types=1);

namespace SharpAPI\TthReviewSentiment;

use GuzzleHttp\Exception\GuzzleException;
use InvalidArgumentException;
use SharpAPI\Core\Client\SharpApiClient;

/**
 * @api
 */
class TthReviewSentimentService extends SharpApiClient
{
    /**
     * Initializes a new instance of the class.
     *
     * @throws InvalidArgumentException if the API key is empty.
     */
    public function __construct()
    {
        parent::__construct(config('sharpapi-tth-review-sentiment.api_key'));
        $this->setApiBaseUrl(
            config(
                'sharpapi-tth-review-sentiment.base_url',
                'https://sharpapi.com/api/v1'
            )
        );
        $this->setApiJobStatusPollingInterval(
            (int) config(
                'sharpapi-tth-review-sentiment.api_job_status_polling_interval',
                5)
        );
        $this->setApiJobStatusPollingWait(
            (int) config(
                'sharpapi-tth-review-sentiment.api_job_status_polling_wait',
                180)
        );
        $this->setUserAgent('SharpAPILaravelTthReviewSentiment/1.0.0');
    }

    /**
     * Parses the Travel/Hospitality product review and provides its sentiment (POSITIVE/NEGATIVE/NEUTRAL)
     * with a score between 0-100%. Great for sentiment report processing for any online store.
     *
     * @param string $text The review text to analyze
     * @return string The sentiment analysis result or an error message
     *
     * @throws GuzzleException
     *
     * @api
     */
    public function travelReviewSentiment(string $text): string
    {
        $response = $this->makeRequest(
            'POST',
            '/tth/review_sentiment',
            ['content' => $text]
        );

        return $this->parseStatusUrl($response);
    }
}