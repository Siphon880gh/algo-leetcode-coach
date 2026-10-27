<?php
declare(strict_types=1);

return [
    'title' => 'Divisible Game',
    'leetcode' => 3984,
    'difficulty' => 'Med',
    'summary' => 'For a fixed k each element is worth +x if k divides it, else −x, and Alice wants the best subarray: Kadane. Only divisors of the elements (plus the smallest k dividing nothing) can matter, so run Kadane per candidate and keep the best difference with the smallest k; return diff × k mod 1e9+7.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'tags' => ['math', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'divisible-game',
    'related_session' => 'divisible-game',
];
