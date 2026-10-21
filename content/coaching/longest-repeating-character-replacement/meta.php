<?php
declare(strict_types=1);

return [
    'title' => 'Longest Repeating Character Replacement: window minus majority ≤ k',
    'leetcode' => 424,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: change at most k uppercase letters to get the longest run of one letter. Sliding window stays legal while length minus the top letter count is at most k. "ABAB", k=2 → 4. "AABABBA", k=1 → 4. Not 3 / 340. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'tags' => ['sliding-window', 'strings', 'hash-table', 'step-by-step'],
    'related_guide' => 'longest-repeating-character-replacement',
];
