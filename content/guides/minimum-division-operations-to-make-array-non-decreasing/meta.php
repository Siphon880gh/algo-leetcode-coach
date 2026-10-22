<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Division Operations to Make Array Non Decreasing: right to left with smallest prime factors',
    'leetcode' => 3326,
    'difficulty' => 'Med',
    'summary' => 'Dividing x by its greatest proper divisor leaves its smallest prime factor, and primes cannot shrink. Scan from the right; when nums[i] > nums[i + 1], replace it by its smallest prime factor once, or fail.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'array', 'math', 'number-theory', 'leetcode'],
    'related_session' => 'minimum-division-operations-to-make-array-non-decreasing',
];
