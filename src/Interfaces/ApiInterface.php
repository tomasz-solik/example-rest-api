<?php
/**
 * rest_api - ApiInterface.php
 *
 * Initial version by: Toamsz Solik
 * Initial version created on: 16.02.22 / 14:34
 */

namespace App\Interfaces;


interface ApiInterface
{
    /**
     * @param string $method
     * @param string $url
     * @param array $params
     * @return bool
     */
    public function makeRequest(string $method, string $url, array $params = []): bool;

}