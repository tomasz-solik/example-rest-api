<?php
/**
 * rest_api - ApiAbstract.php
 *
 * Initial version by: Toamsz Solik
 * Initial version created on: 16.02.22 / 14:30
 */

namespace App\Abstracts;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

abstract class ApiAbstract
{
    /**
     * @var ContainerInterface
     */
    public $container;
    /**
     * @var mixed
     */
    public $apiCredentials;
    /**
     * @var LoggerInterface
     */
    public $logger;
    /**
     * @var Client
     */
    public $clientGuzzle;
    /**
     * @var int
     */
    public $responseCode;
    /**
     * @var string
     */
    public $responseContents;

    /**
     * ApiAbstract constructor.
     * @param ContainerInterface $container
     * @param LoggerInterface $logger
     * @param string $apiConfig
     */
    public function __construct(
        ContainerInterface $container,
        LoggerInterface $logger,
        string $apiConfig
    ) {
        $this->container = $container;
        $this->logger = $logger;
        $this->apiCredentials = $this->container->getParameter($apiConfig);
        $this->clientGuzzle = new Client([
            'base_uri' => $this->apiCredentials['url'],
            'headers' => ['Content-Type' => 'application/json'],
            'exceptions' => false,
            'verify' => false,
            'http_errors' => false,
        ]);
    }

    /**
     * @return string
     */
    public function getResponseContents(): ?string
    {
        return $this->responseContents;
    }

    /**
     * @param string $responseContents
     */
    public function setResponseContents(?string $responseContents): void
    {
        $this->responseContents = $responseContents;
    }

    /**
     * Given response code
     * @return int
     */
    public function getResponseCode(): ?int
    {
        return $this->responseCode;
    }

    /**
     * Set response code
     * @param int $responseCode
     */
    public function setResponseCode(?int $responseCode): void
    {
        $this->responseCode = $responseCode;
    }

    /**
     * @param string $method
     * @param string $url
     * @param array $params
     * @return bool
     */
    public function makeRequest(string $method, string $url, array $params = []): bool
    {
        $result = false;
        try {
            /** @var ResponseInterface $response */
            $response = $this->clientGuzzle->request(
                $method,
                $url,
                $params
            );
            $this->setResponseCode($response->getStatusCode());
            $this->setResponseContents((string)$response->getBody()->getContents());
            $result = true;
        } catch (GuzzleException $e) {
            $this->logger->critical(
                __METHOD__,
                [
                    'ex' => $e->getMessage(),
                ]);
        }

        return $result;
    }

}