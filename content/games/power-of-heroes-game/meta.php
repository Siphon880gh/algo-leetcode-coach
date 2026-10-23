<?php
declare(strict_types=1);

return [
    'title' => 'Power of Heroes: each value as the maximum',
    'leetcode' => 2681,
    'difficulty' => 'Hard',
    'summary' => 'Sort. With x as the group maximum, the minimum ranges over earlier values: x² · (x + s), where s = Σ nums[j]·2^(i−j−1) over j < i, updated as s = 2s + previous value.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'power-of-heroes',
    'related_session' => 'power-of-heroes',
];
