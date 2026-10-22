<?php
declare(strict_types=1);

return [
    'title' => 'Distribute Candies Among Children III: inclusion–exclusion in O(1)',
    'leetcode' => 2927,
    'difficulty' => 'Hard',
    'summary' => 'Without the cap there are C(n + 2, 2) ways. Subtract the ways where some child gets more than limit, add back pairs, and so on: Σ (−1)^i · C(3, i) · C(n − i(limit + 1) + 2, 2).',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'kind' => 'algo',
    'tags' => ['math', 'combinatorics', 'leetcode'],
    'related_session' => 'distribute-candies-among-children-iii',
];
