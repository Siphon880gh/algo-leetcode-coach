<?php
declare(strict_types=1);

return [
    'title' => 'Find the Distinct Difference Array',
    'leetcode' => 2670,
    'difficulty' => 'Easy',
    'summary' => 'Precompute suffix distinct counts from the right with a set; then sweep from the left with another set: diff[i] = prefixDistinct − suffixDistinct(i + 1).',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Table',
    'topic' => 'LeetCode · Hash Table',
    'tags' => ['hash', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'find-the-distinct-difference-array',
    'related_session' => 'find-the-distinct-difference-array',
];
