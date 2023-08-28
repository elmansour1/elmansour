<?php

/**
 * PHP Version 8.1
 * FullTransactionMapper.
 *
 * @category Mapper
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Mapper
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Mapper/FullTransactionMapper.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Mapper;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto\FullTransactionDTO;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Entity\Transaction;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\FullTransactionDTOCollection;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\TransactionCollection;

/**
 * FullTransactionMapper.
 *
 * @codingStandardsIgnoreStart
 * @template-extends BaseEntityMapper<FullTransactionDTO, Transaction, FullTransactionDTOCollection, TransactionCollection>
 * @codingStandardsIgnoreEnd
 *
 * @category Mapper
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Mapper
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Mapper/FullTransactionMapper.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
interface FullTransactionMapper extends BaseEntityMapper
{
}
