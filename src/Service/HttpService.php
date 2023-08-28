<?php

/**
 * PHP Version 8.1
 * HttpService.
 *
 * @category Service
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Service
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Service/HttpService.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Service;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\GeneralNetworkException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\HTTPTokenException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\NetworkException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service\HttpService as BaseHttpService;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service\ParameterService;
use DateTime;
use DateTimeZone;
use DateInterval;

/**
 * HttpService.
 *
 * @category Service
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Service
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Service/HttpService.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
class HttpService implements BaseHttpService
{
    protected ParameterService $parameterService;

    /**
     * Constructor.
     *
     * @param ParameterService $parameterService parameterService
     *
     * @return void
     */
    public function __construct(ParameterService $parameterService)
    {
        $this->parameterService = $parameterService;
    }

    /**
     * GetToken.
     *
     * @param array $parameters parameters
     *
     * @return string
     *
     * @throws \Exception
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     *
     * @psalm-suppress MixedAssignment
     * @psalm-suppress MixedArgument
     */
    public function getToken(array $parameters): string
    {
        $expirationSeconds = $this->parameterService->get(
            AppConstants::TOKEN_EXPIRE_IN,
            false
        );
        $tokenInDatabase = $this->parameterService->getParameter(
            AppConstants::TOKEN,
            false
        );
        $tokenExpired = false;
        $savedToken = false;

        if ($expirationSeconds && $tokenInDatabase) {
            $savedToken = true;
            $date = new DateTime(
                AppConstants::NOW,
                new DateTimeZone($_ENV['TIME_ZONE'])
            );
            $lastTokenDate = $tokenInDatabase->lastUpdatedDate->add(
                new DateInterval(
                    "PT{$expirationSeconds}S"
                )
            );
            if ($lastTokenDate->getTimestamp() <= $date->getTimestamp()) {
                $tokenExpired = true;
            }
        }

        $token = $tokenInDatabase?->value;

        if ($tokenExpired || !$savedToken) {
            $response = $this->sendGETWithBasicAuth($_ENV['API_TOKEN'], $parameters);
            $condition = !array_key_exists(AppConstants::ACCESS_TOKEN, $response) ||
                !array_key_exists(AppConstants::EXPIRE_IN, $response) ||
                !$response[AppConstants::ACCESS_TOKEN] ||
                !$response[AppConstants::EXPIRE_IN];
            if ($condition) {
                throw new HTTPTokenException($_ENV['API_TOKEN']);
            }
            $this->parameterService->setParameter(
                AppConstants::TOKEN,
                $response[AppConstants::ACCESS_TOKEN]
            );
            $this->parameterService->setParameter(
                AppConstants::TOKEN_EXPIRE_IN,
                $response[AppConstants::EXPIRE_IN]
            );
            $token = $response[AppConstants::ACCESS_TOKEN];
        }

        if (!is_string($token)) {
            throw new HTTPTokenException($_ENV['API_TOKEN']);
        }

        return $token;
    }

    /**
     * SendGETWithBasicAuth.
     *
     * @param string $url  url
     * @param array  $data data
     *
     * @return array
     *
     * @throws \Exception
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     */
    public function sendGETWithBasicAuth(string $url, array $data): array
    {
        $token = base64_encode(
            $_ENV['API_USERNAME_TOKEN'] . ':' . $_ENV['API_PASSWORD_TOKEN']
        );

        $headers = [
            sprintf(AppConstants::HEADER_AUTH_BASIC, $token),
        ];

        return $this->sendGET($url, $data, $headers);
    }

    /**
     * SendGETWithToken.
     *
     * @param string $url         url
     * @param array  $data        data
     * @param array  $credentials credentials
     *
     * @return array
     *
     * @throws \Exception
     */
    public function sendGETWithToken(
        string $url,
        array $data,
        array $credentials
    ): array {
        $token = $this->getToken($credentials);

        $headers = [
            sprintf(AppConstants::HEADER_AUTH_BEARER, $token),
            AppConstants::HEADER_CONTENT_TYPE_JSON,
        ];

        return $this->sendGET($url, $data, $headers);
    }

    /**
     * SendPOSTWithToken.
     *
     * @param string $url         url
     * @param array  $data        data
     * @param array  $credentials credentials
     *
     * @return array
     *
     * @throws \Exception
     */
    public function sendPOSTWithToken(
        string $url,
        array $data,
        array $credentials
    ): array {
        $token = $this->getToken($credentials);

        $headers = [
            sprintf(AppConstants::HEADER_AUTH_BEARER, $token),
            AppConstants::HEADER_CONTENT_TYPE_JSON,
        ];

        return $this->sendPOST($url, $data, $headers);
    }

    /**
     * SendPOSTWithTokenSet.
     *
     * @param string      $url     url
     * @param array       $data    data
     * @param array|null  $headers headers
     * @param string|null $token   token
     *
     * @return array
     *
     * @throws NetworkException|GeneralNetworkException
     */
    public function sendPOSTWithTokenSet(
        string $url,
        array $data,
        ?array $headers = null,
        ?string $token = null
    ): array {
        $parameters = [
            CURLOPT_CUSTOMREQUEST => AppConstants::POST,
            CURLOPT_POSTFIELDS => json_encode($data),
        ];

        return $this->sendRequestWithHeaders($url, $parameters, $headers, $token);
    }

    /**
     * SendGetWithTokenSet.
     *
     * @param string      $url     url
     * @param array       $data    data
     * @param array|null  $headers headers
     * @param string|null $token   token
     *
     * @return array
     *
     * @throws NetworkException|GeneralNetworkException
     */
    public function sendGetWithTokenSet(
        string $url,
        array $data,
        array $headers = null,
        ?string $token = null
    ): array {
        $parameters = [
            CURLOPT_URL => $url . '?' . http_build_query($data),
        ];

        return $this->sendRequestWithHeaders($url, $parameters, $headers, $token);
    }

    /**
     * SendAsyncPost.
     *
     * @param string      $url     url
     * @param array       $data    data
     * @param array|null  $headers headers
     * @param string|null $token   token
     *
     * @return array
     *
     * @throws NetworkException|GeneralNetworkException
     */
    public function sendAsyncPost(
        string $url,
        array $data,
        ?array $headers = null,
        ?string $token = null
    ): void {
        $parameters = [
            CURLOPT_CUSTOMREQUEST => AppConstants::POST,
            CURLOPT_POSTFIELDS => json_encode($data),
        ];

        $this->sendAsyncRequest($url, $parameters, $headers, $token, AppConstants::ASYNC_TIMEOUT);
    }

    /**
     * SendAsyncGet.
     *
     * @param string      $url     url
     * @param array       $data    data
     * @param array|null  $headers headers
     * @param string|null $token   token
     *
     * @return array
     *
     * @throws NetworkException|GeneralNetworkException
     */
    public function sendAsyncGet(
        string $url,
        array $data,
        array $headers = null,
        ?string $token = null
    ): void {
        $parameters = [
            CURLOPT_URL => $url . '?' . http_build_query($data),
        ];

        $this->sendAsyncRequest($url, $parameters, $headers, $token, AppConstants::ASYNC_TIMEOUT);
    }

    /**
     * SendPOST.
     *
     * @param string     $url     url
     * @param array      $data    data
     * @param array|null $headers headers
     *
     * @return array
     *
     * @throws NetworkException|GeneralNetworkException
     */
    public function sendPOST(string $url, array $data, ?array $headers = null): array
    {
        $parameters = [
            CURLOPT_CUSTOMREQUEST => AppConstants::POST,
            CURLOPT_POSTFIELDS => json_encode($data),
        ];

        if ($headers) {
            $parameters[CURLOPT_HTTPHEADER] = $headers;
        }

        return $this->sendRequest($url, $parameters);
    }

    /**
     * SendGET.
     *
     * @param string     $url     url
     * @param array      $data    data
     * @param array|null $headers headers
     *
     * @return array
     *
     * @throws NetworkException|GeneralNetworkException
     */
    public function sendGET(string $url, array $data, ?array $headers = null): array
    {
        $parameters = [
            CURLOPT_URL => $url . '?' . http_build_query($data),
        ];

        if ($headers) {
            $parameters[CURLOPT_HTTPHEADER] = $headers;
        }

        return $this->sendRequest($url, $parameters);
    }

    /**
     * SendAsyncRequest.
     *
     * @param string      $url     url
     * @param array       $params  params
     * @param array|null  $headers headers
     * @param string|null $token   token
     * @param int|null    $timeout timeout
     *
     * @return void
     *
     * @throws NetworkException|GeneralNetworkException
     *
     * @SuppressWarnings(PHPMD.EmptyCatchBlock)
     */
    protected function sendAsyncRequest(
        string $url,
        array $params,
        ?array $headers = null,
        ?string $token = null,
        ?int $timeout = null
    ): void {
        try {
            $this->sendRequestWithHeaders($url, $params, $headers, $token, $timeout);
        } catch (\Throwable $throwable) {
        }
    }

    /**
     * SendRequestWithHeaders.
     *
     * @param string      $url     url
     * @param array       $params  params
     * @param array|null  $headers headers
     * @param string|null $token   token
     * @param int|null    $timeout timeout
     *
     * @return array
     *
     * @throws NetworkException|GeneralNetworkException
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     *
     * @psalm-suppress PossiblyUndefinedArrayOffset
     * @psalm-suppress MixedReturnStatement
     * @psalm-suppress MixedAssignment
     * @psalm-suppress MixedInferredReturnType
     */
    protected function sendRequestWithHeaders(
        string $url,
        array $params,
        ?array $headers = null,
        ?string $token = null,
        ?int $timeout = null
    ): array {
        $headersRequest = [];
        if ($headers) {
            $headersRequest = $headers;
        }

        $headersRequest[] = AppConstants::HEADER_CONTENT_TYPE_JSON;

        if ($_ENV['API_TOKEN']) {
            $headerToken = sprintf(AppConstants::HEADER_AUTH_BEARER, $token);
            $headersRequest[] = $headerToken;
        }

        $parameters = $params;
        $parameters[CURLOPT_HTTPHEADER] = $headersRequest;

        return $this->sendRequest($url, $parameters, $timeout);
    }

    /**
     * SendRequest.
     *
     * @param string   $url     url
     * @param array    $params  params
     * @param int|null $timeout timeout
     *
     * @return array
     *
     * @throws NetworkException|GeneralNetworkException
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     *
     * @psalm-suppress PossiblyUndefinedArrayOffset
     * @psalm-suppress MixedReturnStatement
     * @psalm-suppress MixedAssignment
     * @psalm-suppress MixedInferredReturnType
     */
    protected function sendRequest(string $url, array $params, ?int $timeout = null): array
    {
        $result = null;

        if (!$timeout) {
            $timeout = $_ENV['CURL_TIMEOUT'];
        }

        try {
            $curl = curl_init();

            $parameters = [
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => $_ENV['CURL_MAXREDIRS'],
                CURLOPT_TIMEOUT => $timeout,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTPHEADER => [AppConstants::APP_JSON_HEADER],
            ];

            foreach ($params as $key => $value) {
                $parameters[$key] = $value;
            }

            curl_setopt_array(
                $curl,
                $parameters
            );

            $response = curl_exec($curl);

            $result = json_decode((string)$response, true);

            curl_close($curl);

            if (!$result || !$response) {
                $errorMessage = '';

                if (AppConstants::ENV_DEV == $_ENV['APP_ENV']) {
                    $errorMessage = $url;
                }

                throw new NetworkException($errorMessage);
            }
        } catch (\Throwable $exception) {
            if ($exception instanceof NetworkException) {
                throw $exception;
            }

            if (AppConstants::ENV_DEV == $_ENV['APP_ENV']) {
                $mes = ', file :' .
                    $exception->getFile() .
                    ', line: ' . $exception->getLine() .
                    ', message:' . $exception->getMessage();
                throw new GeneralNetworkException($url, $mes);
            }

            throw new GeneralNetworkException($url);
        }

        return $result;
    }
}
