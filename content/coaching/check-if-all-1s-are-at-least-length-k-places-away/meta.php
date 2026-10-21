<?php
declare(strict_types=1);

return [
    'title' => 'Check If All 1s Are at Least Length K Places Away: gap to the previous 1',
    'leetcode' => 1437,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: remember the last 1\'s index; for each new 1, require i − prev − 1 ≥ k. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Arrays',
    'topic' => 'LeetCode · Arrays',
    'related_guide' => 'check-if-all-1s-are-at-least-length-k-places-away',
    'tags' => ['arrays', 'step-by-step'],
];
