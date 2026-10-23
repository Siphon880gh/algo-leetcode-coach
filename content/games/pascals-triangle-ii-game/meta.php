<?php
declare(strict_types=1);

return [
    'title' => 'Pascal\'s Triangle II: update one row from right to left',
    'leetcode' => 119,
    'difficulty' => 'Easy',
    'summary' => 'Keep one array. For the next row, walk j from right to left: row[j] += row[j−1]. Going right to left means row[j−1] is still the old value.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'pascals-triangle-ii',
    'related_session' => 'pascals-triangle-ii',
];
