<?php

/**
 * PHP Version 8.1
 * TransactionMapper.
 *
 * @category Mapper
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Mapper
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Mapper/TransactionMapper.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Mapper;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Entity\Transaction;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto\TransactionDTO as TransactionDTO;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\TransactionCollection;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\TransactionDTOCollection;

/**
 * TransactionMapper.
 *
 * @codingStandardsIgnoreStart
 * @template-extends BaseEntityMapper<TransactionDTO, Transaction, TransactionDTOCollection, TransactionCollection>
 * @codingStandardsIgnoreEnd
 *
 * @category Mapper
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Mapper
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Mapper/TransactionMapper.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
interface TransactionMapper extends BaseEntityMapper
{
}
