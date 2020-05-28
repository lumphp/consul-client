<?php
declare(strict_types=1);
namespace Lum\ConsulClient;

use Lum\ConsulClient\Exception\ConsulError;
use Lum\ConsulClient\Exception\ServerException;
use Lum\HttpClient\DefaultClient as GuzzleClient;
use Lum\HttpClient\Exceptions\HttpClientException;
use Lum\HttpClient\Request;
use Lum\HttpClient\Response;
use Lum\HttpClient\Streams\JsonStream;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

/**
 * Class ConsulClient
 *
 * @package Lum\ConsulClient
 */
final class ConsulClient implements HttpClient
{
    /**
     * @var HttpClient $client
     */
    private $client;
    /** @var LoggerInterface */
    private $logger;
    /**
     * @var string $baseUri
     */
    private $baseUri;

    /**
     * ConsulClient constructor.
     *
     * @param string $baseUri
     * @param GuzzleClient|null $client
     * @param array $options
     * @param LoggerInterface|null $logger
     */
    public function __construct(
        string $baseUri = '',
        ?GuzzleClient $client = null,
        array $options = [],
        ?LoggerInterface $logger = null
    ) {
        $this->baseUri = $baseUri;
        $options = array_merge(
            [
                'http_errors' => false,
            ],
            $options
        );
        $response = new Response;
        $this->client = $client ?: new GuzzleClient($response, (object)$options);
        $this->logger = $logger ?: new NullLogger;
    }

    /**
     * @param string|null $url
     * @param array $options
     *
     * @return ConsulResponse|mixed
     * @throws ServerException
     */
    public function get(?string $url = null, array $options = [])
    {
        return $this->doRequest('GET', $url, $options);
    }

    /**
     * @param string $url
     * @param array $options
     *
     * @return ConsulResponse|mixed
     * @throws ServerException
     */
    public function head(string $url, array $options = [])
    {
        return $this->doRequest('HEAD', $url, $options);
    }

    /**
     * @param string $url
     * @param array $options
     *
     * @return ConsulResponse|mixed
     * @throws ServerException
     */
    public function delete(string $url, array $options = [])
    {
        return $this->doRequest('DELETE', $url, $options);
    }

    /**
     * @param string $url
     * @param array $options
     *
     * @return ConsulResponse|mixed
     * @throws ServerException
     */
    public function put(string $url, array $options = [])
    {
        return $this->doRequest('PUT', $url, $options);
    }

    /**
     * @param string $url
     * @param array $options
     *
     * @return ConsulResponse|mixed
     * @throws ServerException
     */
    public function patch(string $url, array $options = [])
    {
        return $this->doRequest('PATCH', $url, $options);
    }

    /**
     * @param string $url
     * @param array $options
     *
     * @return ConsulResponse|mixed
     * @throws ServerException
     */
    public function post(string $url, array $options = [])
    {
        return $this->doRequest('POST', $url, $options);
    }

    /**
     * @param string $url
     * @param array $options
     *
     * @return ConsulResponse|mixed
     * @throws ServerException
     */
    public function options(string $url, array $options = [])
    {
        return $this->doRequest('OPTIONS', $url, $options);
    }

    /**
     * @param string $method
     * @param string $url
     * @param array $options
     *
     * @return ConsulResponse
     * @throws ServerException
     */
    private function doRequest(string $method, string $url, array $options)
    {
        $uri = sprintf('%s%s', $this->baseUri, $url);
        $this->logger->info(sprintf('%s "%s"', $method, $uri));
        try {
            $body = null;
            if (isset($options['body']) && is_array($options['body'])) {
                $body = new JsonStream($options['body']);
            }
            $request = (new Request($method, $uri));
            if ($body) {
                $request = $request->withBody($body);
            }
            $response = $this->client->sendRequest($request);
        } catch (HttpClientException $e) {
            $message = sprintf('Something went wrong when calling consul (%s).', $e->getMessage());
            $this->logger->error($e->getTraceAsString());
            throw new ServerException(ConsulError::HTTP_CLIENT_ERROR, $message);
        }

        return new ConsulResponse(
            $response->getHeaders(), (string)$response->getBody(), $response->getStatusCode()
        );
    }
}
