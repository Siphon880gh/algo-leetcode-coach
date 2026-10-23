<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Operations to Transform Binary String: DP on used pairs',
    'leetcode' => 3980,
    'difficulty' => 'Med',
    'summary' => 'Decide which adjacent pairs get cleared. A position touched by d clears needs a set before the first if it starts as 0, a set between clears (d − 1), and a final set if it must end as 1. Positions with no clear keep their bit, so a 1 that must become 0 needs a clear. A DP over whether the previous pair was cleared minimises the total.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['greedy', 'string', 'dynamic-programming', 'leetcode'],
    'related_session' => 'minimum-operations-to-transform-binary-string',
];
