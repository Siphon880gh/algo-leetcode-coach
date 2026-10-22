<?php
declare(strict_types=1);

return [
    'title' => 'Substring XOR Queries: precompute every short value',
    'leetcode' => 2564,
    'difficulty' => 'Med',
    'summary' => 'The wanted value is first XOR second, below 2^30. Precompute, for every substring starting with 1 and at most 30 long, the first place each value appears, plus the first 0; then each query is a lookup.',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Table',
    'topic' => 'LeetCode · Hash Table',
    'kind' => 'algo',
    'tags' => ['array', 'hash-table', 'string', 'bit-manipulation', 'leetcode'],
    'related_session' => 'substring-xor-queries',
];
