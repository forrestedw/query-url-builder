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
        $this->assertStringNotContainsString('active', $secondQueryUrl);
    }

    public function testForUrlAcceptsPlainUrl()
    {
        $forUrl = 'this/then/that';

        $url = QueryUrl::forUrl('this/then/that')->build();

        $this->assertStringContainsString($forUrl, "{$url}?");
    }
}
