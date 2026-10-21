<?php
declare(strict_types=1);

return [
    'title' => 'Subdomain Visit Count: credit every suffix',
    'leetcode' => 811,
    'difficulty' => 'Med',
    'summary' => 'Each entry "count domain" also counts for every parent domain. Split on dots and add the count to every suffix, from the full domain down to the top level, then format the totals.',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Map',
    'topic' => 'LeetCode · Hash Map',
    'kind' => 'algo',
    'tags' => ['hash-map', 'strings', 'leetcode'],
    'related_session' => 'subdomain-visit-count',
];
