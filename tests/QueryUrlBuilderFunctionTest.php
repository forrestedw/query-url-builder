<?php

namespace Forrestedw\QueryUrlBuilder\Test;

use Forrestedw\QueryUrlBuilder\QueryUrl;

class QueryUrlBuilderFunctionTest extends TestCase
{
    /**
     * Check that multiple calls to QueryUrl are independent.
     * @return void
     */
    public function testOnlyOneAttributeIsChangedAtATime()
    {
        $firstQueryUrl = QueryUrl::setFilter('active', true)->build();

        $secondQueryUrl = QueryUrl::setFilter('value', true)->build();

        // second query url should not contain 'active'
        $this->assertNotContains('active', $secondQueryUrl);
    }
}
