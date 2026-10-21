<?php
declare(strict_types=1);

return [
    'title' => 'Pairs of Songs With Total Durations Divisible by 60: count remainders',
    'leetcode' => 1010,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: for each song, add the count of earlier songs whose remainder completes it to 60, then record its own remainder. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Table',
    'topic' => 'LeetCode · Hash Table',
    'related_guide' => 'pairs-of-songs-with-total-durations-divisible-by-60',
    'tags' => ['hash-table', 'counting', 'arrays', 'step-by-step'],
];
