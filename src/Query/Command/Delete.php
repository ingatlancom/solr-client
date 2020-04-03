<?php

declare(strict_types=1);

/*
 * This file is part of Solr Client Symfony package.
 *
 * (c) ingatlan.com Zrt. <fejlesztes@ingatlan.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace iCom\SolrClient\Query\Command;

use iCom\SolrClient\JsonHelper;
use iCom\SolrClient\Query\Command;
use iCom\SolrClient\Query\SelectQuery;

/**
 * @see https://lucene.apache.org/solr/guide/8_3/uploading-data-with-index-handlers.html#delete-operations
 *
 * @psalm-immutable
 * @psalm-suppress MissingConstructor
 */
final class Delete implements Command
{
    use JsonHelper;

    /**
     * @var array|SelectQuery
     */
    private $value;

    /**
     * @psalm-pure
     */
    public static function fromIds(array $ids): self
    {
        $delete = new self();
        $delete->value = $ids;

        return $delete;
    }

    /**
     * @psalm-pure
     */
    public static function fromQuery(SelectQuery $query): self
    {
        $delete = new self();
        $delete->value = $query;

        return $delete;
    }

    public function toJson(): string
    {
        if ($this->value instanceof SelectQuery) {
            return $this->value->toJson();
        }

        return self::jsonEncode($this->value);
    }

    public function getName(): string
    {
        return 'delete';
    }
}
