<?php
declare(strict_types=1);

return [
    'title' => 'Number of Ways to Split a String: zero gaps around the cuts',
    'leetcode' => 1573,
    'difficulty' => 'Med',
    'summary' => 'Total ones must split into thirds t. With no ones, any 2 of the n − 1 cut points: C(n−1, 2). Otherwise the first cut can go anywhere in the zero gap after the t-th one, the second after the 2t-th one: multiply the gap sizes + 1.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'tags' => ['math', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'number-of-ways-to-split-a-string',
    'related_session' => 'number-of-ways-to-split-a-string',
];
