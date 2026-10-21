<?php
declare(strict_types=1);

return [
    'title' => 'Largest Multiple of Three: drop the fewest small digits',
    'leetcode' => 1363,
    'difficulty' => 'Hard',
    'summary' => 'A number is divisible by 3 when its digit sum is. Sort digits descending; if the sum mod 3 is r, remove the smallest digit with remainder r, or else the two smallest with remainder 3 − r. Strip a result of only zeros to "0".',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'math', 'leetcode'],
    'related_session' => 'largest-multiple-of-three',
];
