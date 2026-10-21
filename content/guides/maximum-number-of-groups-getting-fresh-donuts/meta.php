<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Number of Groups Getting Fresh Donuts: memo on remainder counts',
    'leetcode' => 1815,
    'difficulty' => 'Hard',
    'summary' => 'Only group sizes mod batchSize matter. Groups with remainder 0 are always happy. For the rest, memoise on the multiset of remaining remainders: the leftover is implied by what was used, and the next group is happy when the leftover is 0.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'memoization', 'bitmask', 'leetcode'],
    'related_session' => 'maximum-number-of-groups-getting-fresh-donuts',
];
