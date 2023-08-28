<?php

/**
 * PHP Version 8.1
 * UtilService.
 *
 * @category Service
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Service
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Service/UtilService.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Service;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service\UtilService as BaseUtilService;
use DateTimeZone;
use DateTime;

/**
 * PHP Version 8.1
 * UtilService.
 *
 * @category Service
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Service
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Service/UtilService.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
class UtilService implements BaseUtilService
{
    /**
     * RandomString.
     *
     * @param int $length length
     *
     * @return string
     */
    public function randomString(int $length = 6): string
    {
        $str = '';
        $characters = array_merge(range('0', '9'));
        $max = count($characters) - 1;
        for ($i = 0; $i < $length; ++$i) {
            $rand = mt_rand(0, $max);
            $str .= $characters[$rand];
        }

        return $str;
    }

    /**
     * NormalizePhone.
     *
     * @param string $phone phone
     *
     * @return string
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     */
    public function normalizePhone(string $phone): string
    {
        $result = "$phone";

        $condition = 7 == strlen($phone) &&
            (str_starts_with($phone, '2') || str_starts_with($phone, '3'));

        if ($condition) {
            $result = '23762' . $phone;
        } elseif (9 == strlen($phone) && str_starts_with($phone, '6')) {
            $result = '237' . $phone;
        } elseif (8 == strlen($phone)) {
            $result = '2376' . $phone;
        } elseif (7 == strlen($phone) && str_starts_with($phone, '7')) {
            $result = '23767' . $phone;
        } elseif (7 == strlen($phone) && str_starts_with($phone, '9')) {
            $result = '23769' . $phone;
        } elseif (7 == strlen($phone) && str_starts_with($phone, '6')) {
            $result = '23766' . $phone;
        }

        return $result;
    }

    /**
     * Slugify.
     *
     * @param string $text    text
     * @param string $divider divider
     *
     * @return string
     */
    public function slugify(string $text, string $divider = '-'): string
    {
        // replace non letter or digits by divider
        $text = preg_replace('~[^\pL\d]+~u', $divider, $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, $divider);

        // remove duplicate divider
        $text = preg_replace('~-+~', $divider, $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }

    /**
     * Clean.
     *
     * @param string $string string
     *
     * @return string
     */
    public function clean(string $string): string
    {
        $string = str_replace(
            ' ',
            '-',
            $string
        ); // Replaces all spaces with hyphens.

        return preg_replace(
            '/[^A-Za-z0-9\-]/',
            '',
            $string
        ); // Removes special chars.
    }

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
    ): string {
        $str = str_replace(
            ' ',
            '',
            ucwords(str_replace($separator, ' ', strtolower($string)))
        );

        if (!$capitalizeFirstChar) {
            $str[0] = strtolower($str[0]);
        }

        return $str;
    }

    /**
     * Cast.
     *
     * @param mixed  $instance  instance
     * @param string $className className
     *
     * @return mixed
     */
    public function cast(mixed $instance, string $className): mixed
    {
        return unserialize(
            sprintf(
                'O:%d:"%s"%s',
                \strlen($className),
                $className,
                strstr(strstr(serialize($instance), '"'), ':')
            )
        );
    }

    /**
     * ConvertDate.
     *
     * @param string $date            date
     * @param string $timeZone        timeZone
     * @param string $convertTimeZone convertTimeZone
     *
     * @return DateTime
     *
     * @throws \Exception
     */
    public function convertDate(
        string $date,
        string $timeZone,
        string $convertTimeZone
    ): DateTime {
        $result = new DateTime($date, new DateTimeZone($timeZone));
        $result->setTimezone(new DateTimeZone($convertTimeZone));

        return $result;
    }

    /**
     * ConvertDateToGMT.
     *
     * @param string $date     date
     * @param string $timeZone timeZone
     *
     * @return DateTime
     *
     * @throws \Exception
     */
    public function convertDateToGMT(string $date, string $timeZone): DateTime
    {
        $result = new DateTime($date, new DateTimeZone($timeZone));
        $result->setTimezone(new DateTimeZone('UTC'));

        return $result;
    }

    /**
     * ArrayToText.
     *
     * @param array $data data
     *
     * @return string
     */
    public function arrayToText(array $data): string
    {
        return http_build_query($data, '', ',');
    }
}
