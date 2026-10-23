<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Number of People That Can Be Caught in Tag',
    'leetcode' => 1989,
    'difficulty' => 'Med',
    'summary' => 'Two pointers: i over "it" players, j over non-it players. Skip j while it is too far left (j < i − dist); if j ≤ i + dist, catch it and advance both; otherwise move i.',
    'category' => 'LeetCode',
    'subcategory' => 'Two Pointers',
    'topic' => 'LeetCode · Two Pointers',
    'tags' => ['two-pointers', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-number-of-people-that-can-be-caught-in-tag',
    'related_session' => 'maximum-number-of-people-that-can-be-caught-in-tag',
];
