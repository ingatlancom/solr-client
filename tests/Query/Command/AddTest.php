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

namespace iCom\SolrClient\Tests\Query\Command;

use iCom\SolrClient\Query\Command\Add;
use PHPUnit\Framework\TestCase;

/**
 * @covers \iCom\SolrClient\Query\Command\Add
 */
final class AddTest extends TestCase
{
    /** @test */
    public function it_has_a_name(): void
    {
        $add = Add::create(['id' => 1]);

        $this->assertEquals('add', $add->getName());
    }

    /** @test */
    public function it_adds_commit_within(): void
    {
        $add = Add::create(['id' => 1]);

        $this->assertSame('{"doc":{"id":1}}', $add->toJson());

        $new = $add->commitWithin(500);

        $this->assertNotSame($add, $new);
        $this->assertSame('{"doc":{"id":1},"commitWithin":500}', $new->toJson());
    }

    /** @test */
    public function it_can_toggle_overwrite(): void
    {
        $add = new Add(['id' => 1]);

        $this->assertSame('{"doc":{"id":1}}', $add->toJson());

        $new = $add->enableOverWrite();

        $this->assertNotSame($add, $new);
        $this->assertSame('{"doc":{"id":1},"overwrite":true}', $new->toJson());

        $new = $add->disableOverWrite();

        $this->assertNotSame($add, $new);
        $this->assertSame('{"doc":{"id":1},"overwrite":false}', $new->toJson());
    }
}
