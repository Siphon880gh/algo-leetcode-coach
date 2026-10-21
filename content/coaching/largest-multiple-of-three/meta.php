<?php
declare(strict_types=1);

return [
    'title' => 'Largest Multiple of Three: fix the digit-sum remainder',
    'leetcode' => 1363,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: sort digits descending, and if the sum mod 3 is r, drop the smallest digit ≡ r or else the two smallest ≡ 3 − r; collapse all zeros to "0". Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'related_guide' => 'largest-multiple-of-three',
    'tags' => ['greedy', 'math', 'step-by-step'],
];
