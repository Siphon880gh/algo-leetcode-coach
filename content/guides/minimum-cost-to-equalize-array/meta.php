<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Cost to Equalize Array: try every final value',
    'leetcode' => 3139,
    'difficulty' => 'Hard',
    'summary' => 'Try every final value t from max to 2 · max. With total = n · t − sum and largest gap g = t − min, pairs are limited by both total / 2 and total − g; singles cover the rest. If cost2 ≥ 2 · cost1, use singles only.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'array', 'enumeration', 'leetcode'],
    'related_session' => 'minimum-cost-to-equalize-array',
];
