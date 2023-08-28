<?php

/**
 * PHP Version 8.1
 * OptionRepository.
 *
 * @category Repository
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Repository
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Repository/OptionRepository.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Repository;

use Afrikpaysas\SymfonyThirdpartyAdapter\Entity\Option;
use Doctrine\Persistence\ManagerRegistry;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\OptionCollection;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Repository\OptionRepository as OptRp;

/**
 * OptionRepository.
 *
 * @template-extends    Repository<Option>
 * @template-implements OptRp
 *
 * @category Repository
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Repository
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Repository/OptionRepository.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
class OptionRepository extends Repository implements OptRp
{
    /**
     * Constructor.
     *
     * @param ManagerRegistry $registry        registry
     * @param string          $entityClass     entityClass
     * @param string          $collectionClass collectionClass
     *
     * @return void
     */
    public function __construct(
        ManagerRegistry $registry,
        string $entityClass = Option::class,
        string $collectionClass = OptionCollection::class
    ) {
        parent::__construct(
            $registry,
            $entityClass,
            $collectionClass
        );
    }

    /**
     * FindOneByOptionId.
     *
     * @param int  $optionId optionId
     * @param bool $throw    throw
     *
     * @return Option|null
     *
     * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
     */
    public function findOneByOptionId(int $optionId, bool $throw = true): ?Option
    {
        return parent::findOneWith([AppConstants::OPTION_ID => $optionId], $throw);
    }

    /**
     * FindOneBySlug.
     *
     * @param string $slug  slug
     * @param bool   $throw throw
     *
     * @return Option|null
     *
     * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
     */
    public function findOneBySlug(string $slug, bool $throw = true): ?Option
    {
        return parent::findOneWith([AppConstants::SLUG => $slug], $throw);
    }

    /**
     * FindByReference.
     *
     * @param string $reference reference
     * @param bool   $throw     throw
     *
     * @return OptionCollection|null
     *
     * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
     */
    public function findByReference(
        string $reference,
        bool $throw = true
    ): ?OptionCollection {
        return parent::findWith([AppConstants::REFERENCE => $reference], $throw);
    }

    /**
     * FindOneByReferenceAndSlug.
     *
     * @param string $reference reference
     * @param string $slug      slug
     * @param bool   $throw     throw
     *
     * @return Option|null
     *
     * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
     */
    public function findOneByReferenceAndSlug(
        string $reference,
        string $slug,
        bool $throw = true
    ): ?Option {
        return parent::findOneWith(
            [
                AppConstants::REFERENCE => $reference,
                AppConstants::SLUG => $slug,
            ],
            $throw
        );
    }

    /**
     * FindAllByReference.
     *
     * @param string|null $reference reference
     *
     * @return array
     */
    public function findAllByReference(?string $reference = null): array
    {
        $entityManager = $this->getEntityManager();

        $where = '';

        if ($reference) {
            $where = 'WHERE r.reference = :reference';
        }

        $query = <<<EOF
SELECT
    r.optionId,
    r.name,
    r.slug,
    r.amount,
    r.reference,
    r.status,
    DATE_FORMAT(r.createdDate, '%Y-%m-%d %H:%i:%s') as date
FROM Afrikpaysas\SymfonyThirdpartyAdapter\Entity\Option r 
$where ORDER BY r.amount ASC
EOF;

        $query = $entityManager->createQuery($query);

        if ($reference) {
            $query->setParameter('reference', $reference);
        }

        return $query->getArrayResult();
    }
}
