<?php
declare(strict_types=1);

return [
    'title' => 'Number of Subarrays with Bounded Maximum',
    'leetcode' => 795,
    'difficulty' => 'Med',
    'summary' => 'Track the last index with a value > right (a breaker) and the last index with a value in [left, right]. Each end i adds (lastGood − lastBreaker) when positive.',
    'category' => 'LeetCode',
    'subcategory' => 'Two Pointers',
    'topic' => 'LeetCode · Two Pointers',
    'tags' => ['two-pointers', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'number-of-subarrays-with-bounded-maximum',
    'related_session' => 'number-of-subarrays-with-bounded-maximum',
];
