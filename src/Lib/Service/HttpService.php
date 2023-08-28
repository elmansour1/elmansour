<?php

/**
 * PHP Version 8.1
 * HttpService.
 *
 * @category Service
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Service/HttpService.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\GeneralNetworkException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\NetworkException;

/**
 * HttpService.
 *
 * @category Service
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Service/HttpService.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
interface HttpService
{
    /**
     * GetToken.
     *
     * @param array $parameters parameters
     *
     * @return string
     *
     * @throws \Exception
     */
    public function getToken(array $parameters): string;

    /**
     * SendGETWithBasicAuth.
     *
     * @param string $url  url
     * @param array  $data data
     *
     * @return array
     *
     * @throws \Exception
     */
    public function sendGETWithBasicAuth(string $url, array $data): array;

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
    ): array;

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
    ): array;

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
    ): array;

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
    ): array;

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
    public function sendPOST(
        string $url,
        array $data,
        ?array $headers = null
    ): array;

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
    public function sendGET(
        string $url,
        array $data,
        ?array $headers = null
    ): array;

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
    ): void;

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
    ): void;
}
