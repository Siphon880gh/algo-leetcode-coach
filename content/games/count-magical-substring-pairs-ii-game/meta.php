<?php
declare(strict_types=1);

return [
    'title' => 'Count Magical Substring Pairs II',
    'leetcode' => 4091,
    'difficulty' => 'Hard',
    'summary' => 'At the split after index j, L[j][d] is the longest substring ending at j with at most d distinct letters, and R[j + 1][d] the same starting at j + 1. Exactly-d counts are L[j][d] − L[j][d − 1], so the split adds the sum over d of (exact left) times (exact right).',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'tags' => ['sliding-window', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'count-magical-substring-pairs-ii',
    'related_session' => 'count-magical-substring-pairs-ii',
];
