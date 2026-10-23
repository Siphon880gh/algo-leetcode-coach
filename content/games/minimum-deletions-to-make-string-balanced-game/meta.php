<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Deletions to Make String Balanced: delete this a or every earlier b',
    'leetcode' => 1653,
    'difficulty' => 'Med',
    'summary' => 'Scan with bCount. On "b": bCount++. On "a": del = min(del + 1, bCount).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-deletions-to-make-string-balanced',
    'related_session' => 'minimum-deletions-to-make-string-balanced',
];
