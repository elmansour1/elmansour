<?php

/**
 * PHP Version 8.1
 * ReferenceMapper.
 *
 * @category Mapper
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Mapper
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Mapper/ReferenceMapper.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Mapper;

use Afrikpaysas\SymfonyThirdpartyAdapter\Entity\Transaction;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto\TransactionDTO;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Mapper\TransactionMapper as TrxM;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\TransactionCollection;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\TransactionDTOCollection;

/**
 * TransactionMapper.
 *
 * @category Mapper
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Mapper
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Mapper/ReferenceMapper.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 *
 * @codingStandardsIgnoreStart
 * @template-extends    BaseEntityMapper<TransactionDTO, Transaction, TransactionDTOCollection, Transaction>
 * @codingStandardsIgnoreEnd
 */
class TransactionMapper extends BaseEntityMapper implements TrxM
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
        string $dtoClass = TransactionDTO::class,
        string $entitiesClass = TransactionCollection::class,
        string $dtosClass = TransactionDTOCollection::class
    ) {
        parent::__construct($entityClass, $dtoClass, $entitiesClass, $dtosClass);
    }
}
