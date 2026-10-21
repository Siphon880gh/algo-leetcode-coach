<?php
declare(strict_types=1);

return [
    'title' => 'Minimize Rounding Error to Meet Target: floor all, then ceil the largest fractions',
    'leetcode' => 1058,
    'difficulty' => 'Med',
    'summary' => 'Rounding every price down gives the lowest reachable sum; each non-integer price rounded up adds exactly 1. So the number of round-ups is fixed, and the cheapest choice rounds up the prices with the largest fractional parts.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'sorting', 'math', 'leetcode'],
    'related_session' => 'minimize-rounding-error-to-meet-target',
];
