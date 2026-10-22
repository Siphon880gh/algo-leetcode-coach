<?php
declare(strict_types=1);

return [
    'title' => 'Number of Ways to Reach a Position After Exactly k Steps: one binomial',
    'leetcode' => 2400,
    'difficulty' => 'Med',
    'summary' => 'With d = |endPos − startPos|, the walk needs (k + d) / 2 steps toward the target and the rest away. If d > k or k − d is odd there is no way; otherwise the answer is C(k, (k + d) / 2) mod 10^9 + 7.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'kind' => 'algo',
    'tags' => ['math', 'dynamic-programming', 'combinatorics', 'leetcode'],
    'related_session' => 'number-of-ways-to-reach-a-position-after-exactly-k-steps',
];
