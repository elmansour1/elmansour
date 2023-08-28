<?php

/**
 * PHP Version 8.1
 * FullTransactionMapper.
 *
 * @category Mapper
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Mapper
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Mapper/FullTransactionMapper.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Mapper;

use Afrikpaysas\SymfonyThirdpartyAdapter\Entity\Transaction;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto\FullTransactionDTO;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Mapper\FullTransactionMapper as TrxM;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\FullTransactionDTOCollection;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\TransactionCollection;

/**
 * FullTransactionMapper.
 *
 * @category Mapper
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Mapper
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Mapper/FullTransactionMapper.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 *
 * @codingStandardsIgnoreStart
 * @template-extends    BaseEntityMapper<FullTransactionDTO, Transaction, FullTransactionDTOCollection, Transaction>
 * @codingStandardsIgnoreEnd
 */
class FullTransactionMapper extends BaseEntityMapper implements TrxM
{
    /**
     * Constructor.
     *
     * @param string $entityClass   entityClass
     * @param string $dtoClass      dtoClass
     * @param string $entitiesClass entitiesClass
     * @param string $dtosClass     dtosClass
     *
     * @return void
     */
    public function __construct(
        string $entityClass = Transaction::class,
        string $dtoClass = FullTransactionDTO::class,
        string $entitiesClass = TransactionCollection::class,
        string $dtosClass = FullTransactionDTOCollection::class
    ) {
        parent::__construct($entityClass, $dtoClass, $entitiesClass, $dtosClass);
    }
}
