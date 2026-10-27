<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Removals to Balance Array',
    'leetcode' => 3634,
    'difficulty' => 'Med',
    'summary' => 'Sort, then keep a window [l, r] with a[r] ≤ k × a[l]. For each r move l right while the condition fails; the largest window is what you keep, so the answer is n − best window.',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'tags' => ['sliding-window', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-removals-to-balance-array',
    'related_session' => 'minimum-removals-to-balance-array',
];
