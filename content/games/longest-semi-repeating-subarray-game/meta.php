<?php
declare(strict_types=1);

return [
    'title' => 'Longest Semi-Repeating Subarray',
    'leetcode' => 3641,
    'difficulty' => 'Med',
    'summary' => 'Sliding window with counts. Track how many distinct values appear at least twice in the window; when that exceeds k, move the left edge (a count dropping from 2 to 1 lowers it).',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'tags' => ['sliding-window', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'longest-semi-repeating-subarray',
    'related_session' => 'longest-semi-repeating-subarray',
];
