<?php

/**
 * ConnectedSitesApi
 * PHP version 5
 *
 * @category Class
 * @package  MailchimpMarketing
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
/**
 * Mailchimp Marketing API
 *
 * No description provided (generated by Swagger Codegen https://github.com/swagger-api/swagger-codegen)
 *
 * OpenAPI spec version: 3.0.25
 * Contact: apihelp@mailchimp.com
 * Generated by: https://github.com/swagger-api/swagger-codegen.git
 * Swagger Codegen version: 2.4.12
 */
/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Do not edit the class manually.
 */
namespace Lauant\MCD\MailchimpMarketing\Api;

use Lauant\MCD\GuzzleHttp\Client;
use Lauant\MCD\GuzzleHttp\ClientInterface;
use Lauant\MCD\GuzzleHttp\Exception\RequestException;
use Lauant\MCD\GuzzleHttp\Psr7\MultipartStream;
use Lauant\MCD\GuzzleHttp\Psr7\Request;
use Lauant\MCD\GuzzleHttp\RequestOptions;
use Lauant\MCD\MailchimpMarketing\ApiException;
use Lauant\MCD\MailchimpMarketing\Configuration;
use Lauant\MCD\MailchimpMarketing\HeaderSelector;
use Lauant\MCD\MailchimpMarketing\ObjectSerializer;
class ConnectedSitesApi
{
    protected $client;
    protected $config;
    protected $headerSelector;
    public function __construct(\Lauant\MCD\MailchimpMarketing\Configuration $config = null)
    {
        $this->client = new \Lauant\MCD\GuzzleHttp\Client(['defaults' => ['timeout' => 120.0]]);
        $this->headerSelector = new \Lauant\MCD\MailchimpMarketing\HeaderSelector();
        $this->config = $config ?: new \Lauant\MCD\MailchimpMarketing\Configuration();
    }
    public function getConfig()
    {
        return $this->config;
    }
    public function remove($connected_site_id)
    {
        $this->removeWithHttpInfo($connected_site_id);
    }
    public function removeWithHttpInfo($connected_site_id)
    {
        $request = $this->removeRequest($connected_site_id);
        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (\Lauant\MCD\GuzzleHttp\Exception\RequestException $e) {
                throw $e;
            }
            $statusCode = $response->getStatusCode();
            if ($statusCode < 200 || $statusCode > 299) {
                throw new \Lauant\MCD\MailchimpMarketing\ApiException(\sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }
            $responseBody = $response->getBody();
            $content = $responseBody->getContents();
            $content = \json_decode($content);
            return $content;
        } catch (\Lauant\MCD\MailchimpMarketing\ApiException $e) {
            throw $e->getResponseBody();
        }
    }
    protected function removeRequest($connected_site_id)
    {
        // verify the required parameter 'connected_site_id' is set
        if ($connected_site_id === null || \is_array($connected_site_id) && \count($connected_site_id) === 0) {
            throw new \InvalidArgumentException('Missing the required parameter $connected_site_id when calling ');
        }
        $resourcePath = '/connected-sites/{connected_site_id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = \false;
        // path params
        if ($connected_site_id !== null) {
            $resourcePath = \str_replace('{' . 'connected_site_id' . '}', \Lauant\MCD\MailchimpMarketing\ObjectSerializer::toPathValue($connected_site_id), $resourcePath);
        }
        // body params
        $_tempBody = null;
        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(['application/json', 'application/problem+json']);
        } else {
            $headers = $this->headerSelector->selectHeaders(['application/json', 'application/problem+json'], ['application/json']);
        }
        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody;
            if ($headers['Content-Type'] === 'application/json') {
                if ($httpBody instanceof \stdClass) {
                    $httpBody = \Lauant\MCD\GuzzleHttp\json_encode($httpBody);
                }
                if (\is_array($httpBody)) {
                    $httpBody = \Lauant\MCD\GuzzleHttp\json_encode(\Lauant\MCD\MailchimpMarketing\ObjectSerializer::sanitizeForSerialization($httpBody));
                }
            }
        } elseif (\count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = ['name' => $formParamName, 'contents' => $formParamValue];
                }
                $httpBody = new \Lauant\MCD\GuzzleHttp\Psr7\MultipartStream($multipartContents);
            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \Lauant\MCD\GuzzleHttp\json_encode($formParams);
            } else {
                $httpBody = \Lauant\MCD\GuzzleHttp\Psr7\build_query($formParams);
            }
        }
        // Basic Authentication
        if (!empty($this->config->getUsername()) && !empty($this->config->getPassword())) {
            $headers['Authorization'] = 'Basic ' . \base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }
        // OAuth Authentication
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }
        $headers = \array_merge($defaultHeaders, $headerParams, $headers);
        $query = \Lauant\MCD\GuzzleHttp\Psr7\build_query($queryParams);
        return new \Lauant\MCD\GuzzleHttp\Psr7\Request('DELETE', $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''), $headers, $httpBody);
    }
    public function list($fields = null, $exclude_fields = null, $count = '10', $offset = '0')
    {
        $response = $this->listWithHttpInfo($fields, $exclude_fields, $count, $offset);
        return $response;
    }
    public function listWithHttpInfo($fields = null, $exclude_fields = null, $count = '10', $offset = '0')
    {
        $request = $this->listRequest($fields, $exclude_fields, $count, $offset);
        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (\Lauant\MCD\GuzzleHttp\Exception\RequestException $e) {
                throw $e;
            }
            $statusCode = $response->getStatusCode();
            if ($statusCode < 200 || $statusCode > 299) {
                throw new \Lauant\MCD\MailchimpMarketing\ApiException(\sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }
            $responseBody = $response->getBody();
            $content = $responseBody->getContents();
            $content = \json_decode($content);
            return $content;
        } catch (\Lauant\MCD\MailchimpMarketing\ApiException $e) {
            throw $e->getResponseBody();
        }
    }
    protected function listRequest($fields = null, $exclude_fields = null, $count = '10', $offset = '0')
    {
        if ($count !== null && $count > 1000) {
            throw new \InvalidArgumentException('invalid value for "$count" when calling ConnectedSitesApi., must be smaller than or equal to 1000.');
        }
        $resourcePath = '/connected-sites';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = \false;
        // query params
        if (\is_array($fields)) {
            $queryParams['fields'] = $fields;
        } else {
            if ($fields !== null) {
                $queryParams['fields'] = \Lauant\MCD\MailchimpMarketing\ObjectSerializer::toQueryValue($fields);
            }
        }
        // query params
        if (\is_array($exclude_fields)) {
            $queryParams['exclude_fields'] = $exclude_fields;
        } else {
            if ($exclude_fields !== null) {
                $queryParams['exclude_fields'] = \Lauant\MCD\MailchimpMarketing\ObjectSerializer::toQueryValue($exclude_fields);
            }
        }
        // query params
        if ($count !== null) {
            $queryParams['count'] = \Lauant\MCD\MailchimpMarketing\ObjectSerializer::toQueryValue($count);
        }
        // query params
        if ($offset !== null) {
            $queryParams['offset'] = \Lauant\MCD\MailchimpMarketing\ObjectSerializer::toQueryValue($offset);
        }
        // body params
        $_tempBody = null;
        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(['application/json', 'application/problem+json']);
        } else {
            $headers = $this->headerSelector->selectHeaders(['application/json', 'application/problem+json'], ['application/json']);
        }
        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody;
            if ($headers['Content-Type'] === 'application/json') {
                if ($httpBody instanceof \stdClass) {
                    $httpBody = \Lauant\MCD\GuzzleHttp\json_encode($httpBody);
                }
                if (\is_array($httpBody)) {
                    $httpBody = \Lauant\MCD\GuzzleHttp\json_encode(\Lauant\MCD\MailchimpMarketing\ObjectSerializer::sanitizeForSerialization($httpBody));
                }
            }
        } elseif (\count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = ['name' => $formParamName, 'contents' => $formParamValue];
                }
                $httpBody = new \Lauant\MCD\GuzzleHttp\Psr7\MultipartStream($multipartContents);
            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \Lauant\MCD\GuzzleHttp\json_encode($formParams);
            } else {
                $httpBody = \Lauant\MCD\GuzzleHttp\Psr7\build_query($formParams);
            }
        }
        // Basic Authentication
        if (!empty($this->config->getUsername()) && !empty($this->config->getPassword())) {
            $headers['Authorization'] = 'Basic ' . \base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }
        // OAuth Authentication
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }
        $headers = \array_merge($defaultHeaders, $headerParams, $headers);
        $query = \Lauant\MCD\GuzzleHttp\Psr7\build_query($queryParams);
        return new \Lauant\MCD\GuzzleHttp\Psr7\Request('GET', $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''), $headers, $httpBody);
    }
    public function get($connected_site_id, $fields = null, $exclude_fields = null)
    {
        $response = $this->getWithHttpInfo($connected_site_id, $fields, $exclude_fields);
        return $response;
    }
    public function getWithHttpInfo($connected_site_id, $fields = null, $exclude_fields = null)
    {
        $request = $this->getRequest($connected_site_id, $fields, $exclude_fields);
        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (\Lauant\MCD\GuzzleHttp\Exception\RequestException $e) {
                throw $e;
            }
            $statusCode = $response->getStatusCode();
            if ($statusCode < 200 || $statusCode > 299) {
                throw new \Lauant\MCD\MailchimpMarketing\ApiException(\sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }
            $responseBody = $response->getBody();
            $content = $responseBody->getContents();
            $content = \json_decode($content);
            return $content;
        } catch (\Lauant\MCD\MailchimpMarketing\ApiException $e) {
            throw $e->getResponseBody();
        }
    }
    protected function getRequest($connected_site_id, $fields = null, $exclude_fields = null)
    {
        // verify the required parameter 'connected_site_id' is set
        if ($connected_site_id === null || \is_array($connected_site_id) && \count($connected_site_id) === 0) {
            throw new \InvalidArgumentException('Missing the required parameter $connected_site_id when calling ');
        }
        $resourcePath = '/connected-sites/{connected_site_id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = \false;
        // query params
        if (\is_array($fields)) {
            $queryParams['fields'] = $fields;
        } else {
            if ($fields !== null) {
                $queryParams['fields'] = \Lauant\MCD\MailchimpMarketing\ObjectSerializer::toQueryValue($fields);
            }
        }
        // query params
        if (\is_array($exclude_fields)) {
            $queryParams['exclude_fields'] = $exclude_fields;
        } else {
            if ($exclude_fields !== null) {
                $queryParams['exclude_fields'] = \Lauant\MCD\MailchimpMarketing\ObjectSerializer::toQueryValue($exclude_fields);
            }
        }
        // path params
        if ($connected_site_id !== null) {
            $resourcePath = \str_replace('{' . 'connected_site_id' . '}', \Lauant\MCD\MailchimpMarketing\ObjectSerializer::toPathValue($connected_site_id), $resourcePath);
        }
        // body params
        $_tempBody = null;
        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(['application/json', 'application/problem+json']);
        } else {
            $headers = $this->headerSelector->selectHeaders(['application/json', 'application/problem+json'], ['application/json']);
        }
        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody;
            if ($headers['Content-Type'] === 'application/json') {
                if ($httpBody instanceof \stdClass) {
                    $httpBody = \Lauant\MCD\GuzzleHttp\json_encode($httpBody);
                }
                if (\is_array($httpBody)) {
                    $httpBody = \Lauant\MCD\GuzzleHttp\json_encode(\Lauant\MCD\MailchimpMarketing\ObjectSerializer::sanitizeForSerialization($httpBody));
                }
            }
        } elseif (\count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = ['name' => $formParamName, 'contents' => $formParamValue];
                }
                $httpBody = new \Lauant\MCD\GuzzleHttp\Psr7\MultipartStream($multipartContents);
            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \Lauant\MCD\GuzzleHttp\json_encode($formParams);
            } else {
                $httpBody = \Lauant\MCD\GuzzleHttp\Psr7\build_query($formParams);
            }
        }
        // Basic Authentication
        if (!empty($this->config->getUsername()) && !empty($this->config->getPassword())) {
            $headers['Authorization'] = 'Basic ' . \base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }
        // OAuth Authentication
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }
        $headers = \array_merge($defaultHeaders, $headerParams, $headers);
        $query = \Lauant\MCD\GuzzleHttp\Psr7\build_query($queryParams);
        return new \Lauant\MCD\GuzzleHttp\Psr7\Request('GET', $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''), $headers, $httpBody);
    }
    public function create($body)
    {
        $response = $this->createWithHttpInfo($body);
        return $response;
    }
    public function createWithHttpInfo($body)
    {
        $request = $this->createRequest($body);
        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (\Lauant\MCD\GuzzleHttp\Exception\RequestException $e) {
                throw $e;
            }
            $statusCode = $response->getStatusCode();
            if ($statusCode < 200 || $statusCode > 299) {
                throw new \Lauant\MCD\MailchimpMarketing\ApiException(\sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }
            $responseBody = $response->getBody();
            $content = $responseBody->getContents();
            $content = \json_decode($content);
            return $content;
        } catch (\Lauant\MCD\MailchimpMarketing\ApiException $e) {
            throw $e->getResponseBody();
        }
    }
    protected function createRequest($body)
    {
        // verify the required parameter 'body' is set
        if ($body === null || \is_array($body) && \count($body) === 0) {
            throw new \InvalidArgumentException('Missing the required parameter $body when calling ');
        }
        $resourcePath = '/connected-sites';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = \false;
        // body params
        $_tempBody = null;
        if (isset($body)) {
            $_tempBody = $body;
        }
        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(['application/json', 'application/problem+json']);
        } else {
            $headers = $this->headerSelector->selectHeaders(['application/json', 'application/problem+json'], ['application/json']);
        }
        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody;
            if ($headers['Content-Type'] === 'application/json') {
                if ($httpBody instanceof \stdClass) {
                    $httpBody = \Lauant\MCD\GuzzleHttp\json_encode($httpBody);
                }
                if (\is_array($httpBody)) {
                    $httpBody = \Lauant\MCD\GuzzleHttp\json_encode(\Lauant\MCD\MailchimpMarketing\ObjectSerializer::sanitizeForSerialization($httpBody));
                }
            }
        } elseif (\count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = ['name' => $formParamName, 'contents' => $formParamValue];
                }
                $httpBody = new \Lauant\MCD\GuzzleHttp\Psr7\MultipartStream($multipartContents);
            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \Lauant\MCD\GuzzleHttp\json_encode($formParams);
            } else {
                $httpBody = \Lauant\MCD\GuzzleHttp\Psr7\build_query($formParams);
            }
        }
        // Basic Authentication
        if (!empty($this->config->getUsername()) && !empty($this->config->getPassword())) {
            $headers['Authorization'] = 'Basic ' . \base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }
        // OAuth Authentication
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }
        $headers = \array_merge($defaultHeaders, $headerParams, $headers);
        $query = \Lauant\MCD\GuzzleHttp\Psr7\build_query($queryParams);
        return new \Lauant\MCD\GuzzleHttp\Psr7\Request('POST', $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''), $headers, $httpBody);
    }
    public function verifyScriptInstallation($connected_site_id)
    {
        $this->verifyScriptInstallationWithHttpInfo($connected_site_id);
    }
    public function verifyScriptInstallationWithHttpInfo($connected_site_id)
    {
        $request = $this->verifyScriptInstallationRequest($connected_site_id);
        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (\Lauant\MCD\GuzzleHttp\Exception\RequestException $e) {
                throw $e;
            }
            $statusCode = $response->getStatusCode();
            if ($statusCode < 200 || $statusCode > 299) {
                throw new \Lauant\MCD\MailchimpMarketing\ApiException(\sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }
            $responseBody = $response->getBody();
            $content = $responseBody->getContents();
            $content = \json_decode($content);
            return $content;
        } catch (\Lauant\MCD\MailchimpMarketing\ApiException $e) {
            throw $e->getResponseBody();
        }
    }
    protected function verifyScriptInstallationRequest($connected_site_id)
    {
        // verify the required parameter 'connected_site_id' is set
        if ($connected_site_id === null || \is_array($connected_site_id) && \count($connected_site_id) === 0) {
            throw new \InvalidArgumentException('Missing the required parameter $connected_site_id when calling ');
        }
        $resourcePath = '/connected-sites/{connected_site_id}/actions/verify-script-installation';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = \false;
        // path params
        if ($connected_site_id !== null) {
            $resourcePath = \str_replace('{' . 'connected_site_id' . '}', \Lauant\MCD\MailchimpMarketing\ObjectSerializer::toPathValue($connected_site_id), $resourcePath);
        }
        // body params
        $_tempBody = null;
        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(['application/json', 'application/problem+json']);
        } else {
            $headers = $this->headerSelector->selectHeaders(['application/json', 'application/problem+json'], ['application/json']);
        }
        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody;
            if ($headers['Content-Type'] === 'application/json') {
                if ($httpBody instanceof \stdClass) {
                    $httpBody = \Lauant\MCD\GuzzleHttp\json_encode($httpBody);
                }
                if (\is_array($httpBody)) {
                    $httpBody = \Lauant\MCD\GuzzleHttp\json_encode(\Lauant\MCD\MailchimpMarketing\ObjectSerializer::sanitizeForSerialization($httpBody));
                }
            }
        } elseif (\count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = ['name' => $formParamName, 'contents' => $formParamValue];
                }
                $httpBody = new \Lauant\MCD\GuzzleHttp\Psr7\MultipartStream($multipartContents);
            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \Lauant\MCD\GuzzleHttp\json_encode($formParams);
            } else {
                $httpBody = \Lauant\MCD\GuzzleHttp\Psr7\build_query($formParams);
            }
        }
        // Basic Authentication
        if (!empty($this->config->getUsername()) && !empty($this->config->getPassword())) {
            $headers['Authorization'] = 'Basic ' . \base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }
        // OAuth Authentication
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }
        $headers = \array_merge($defaultHeaders, $headerParams, $headers);
        $query = \Lauant\MCD\GuzzleHttp\Psr7\build_query($queryParams);
        return new \Lauant\MCD\GuzzleHttp\Psr7\Request('POST', $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''), $headers, $httpBody);
    }
    protected function createHttpClientOption()
    {
        $options = [];
        if ($this->config->getDebug()) {
            $options[\Lauant\MCD\GuzzleHttp\RequestOptions::DEBUG] = \fopen($this->config->getDebugFile(), 'a');
            if (!$options[\Lauant\MCD\GuzzleHttp\RequestOptions::DEBUG]) {
                throw new \RuntimeException('Failed to open the debug file: ' . $this->config->getDebugFile());
            }
        }
        return $options;
    }
}