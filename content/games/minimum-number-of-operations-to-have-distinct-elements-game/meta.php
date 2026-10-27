<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Number of Operations to Have Distinct Elements',
    'leetcode' => 3779,
    'difficulty' => 'Med',
    'summary' => 'Scan from the right with a set. The first value seen twice, at index i, must be removed, so the prefix 0..i has to go: ⌈(i + 1) / 3⌉ operations. No repeat means 0.',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Table',
    'topic' => 'LeetCode · Hash Table',
    'tags' => ['hash', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-number-of-operations-to-have-distinct-elements',
    'related_session' => 'minimum-number-of-operations-to-have-distinct-elements',
];
