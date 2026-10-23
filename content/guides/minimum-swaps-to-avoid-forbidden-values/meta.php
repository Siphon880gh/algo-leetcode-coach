<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Swaps to Avoid Forbidden Values: pair up bad positions',
    'leetcode' => 3785,
    'difficulty' => 'Hard',
    'summary' => 'A position is bad when nums[i] = forbidden[i]. Swapping two bad positions with different values fixes both, so the answer is max(⌈bad / 2⌉, the largest bad count of one value), after a feasibility check.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'array', 'hash-table', 'counting', 'leetcode'],
    'related_session' => 'minimum-swaps-to-avoid-forbidden-values',
];
