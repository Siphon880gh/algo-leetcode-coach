<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Distance Between Three Equal Elements II',
    'leetcode' => 3741,
    'difficulty' => 'Med',
    'summary' => 'Same formula, done in one pass: keep the last two indices of each value in a hash map. When a value appears again at k, its triple costs 2 × (k − the older stored index).',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Table',
    'topic' => 'LeetCode · Hash Table',
    'tags' => ['hash', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-distance-between-three-equal-elements-ii',
    'related_session' => 'minimum-distance-between-three-equal-elements-ii',
];
