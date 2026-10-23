<?php
declare(strict_types=1);

return [
    'title' => 'Number of Good Ways to Split a String: distinct counts on both sides',
    'leetcode' => 1525,
    'difficulty' => 'Med',
    'summary' => 'Precompute distinct letters in every prefix and every suffix. A split after index i is good if prefix[i] == suffix[i+1].',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'number-of-good-ways-to-split-a-string',
    'related_session' => 'number-of-good-ways-to-split-a-string',
];
