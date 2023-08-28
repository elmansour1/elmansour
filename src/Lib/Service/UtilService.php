<?php

/**
 * PHP Version 8.1
 * UtilService.
 *
 * @category Service
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Service/UtilService.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service;

/**
 * PHP Version 8.1
 * UtilService.
 *
 * @category Service
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Service/UtilService.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
interface UtilService
{
    /**
     * RandomString.
     *
     * @param int $length length
     *
     * @return string
     */
    public function randomString(int $length = 6): string;

    /**
     * NormalizePhone.
     *
     * @param string $phone phone
     *
     * @return string
     */
    public function normalizePhone(string $phone): string;

    /**
     * Slugify.
     *
     * @param string $text    text
     * @param string $divider divider
     *
     * @return string
     */
    public function slugify(string $text, string $divider = '-'): string;

    /**
     * Clean.
     *
     * @param string $string string
     *
     * @return string
     */
    public function clean(string $string): string;

    /**
     * DashesToCamelCase.
     *
     * @param string $string              string
     * @param string $separator           separator
     * @param bool   $capitalizeFirstChar capitalizeFirstChar
     *
     * @return string
     *
     * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
     */
    public function dashesToCamelCase(
        string $string,
        string $separator,
        bool $capitalizeFirstChar = false
    ): string;

    /**
     * Cast.
     *
     * @param mixed  $instance  instance
     * @param string $className className
     *
     * @return mixed
     */
    public function cast(mixed $instance, string $className): mixed;

    /**
     * ConvertDate.
     *
     * @param string $date            date
     * @param string $timeZone        timeZone
     * @param string $convertTimeZone convertTimeZone
     *
     * @return \DateTime
     *
     * @throws \Exception
     */
    public function convertDate(
        string $date,
        string $timeZone,
        string $convertTimeZone
    ): \DateTime;

    /**
     * ConvertDateToGMT.
     *
     * @param string $date     date
     * @param string $timeZone timeZone
     *
     * @return \DateTime
     *
     * @throws \Exception
     */
    public function convertDateToGMT(string $date, string $timeZone): \DateTime;

    /**
     * ArrayToText.
     *
     * @param array $data data
     *
     * @return string
     */
    public function arrayToText(array $data): string;
}
