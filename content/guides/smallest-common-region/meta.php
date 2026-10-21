<?php
declare(strict_types=1);

return [
    'title' => 'Smallest Common Region: lowest common ancestor via parents',
    'leetcode' => 1257,
    'difficulty' => 'Med',
    'summary' => 'Record each region\'s parent. Collect all ancestors of the first region (itself included), then walk up from the second region until you hit one of them.',
    'category' => 'LeetCode',
    'subcategory' => 'Tree',
    'topic' => 'LeetCode · Tree',
    'kind' => 'algo',
    'tags' => ['tree', 'hash-table', 'lowest-common-ancestor', 'leetcode'],
    'related_session' => 'smallest-common-region',
];
