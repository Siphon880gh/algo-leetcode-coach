<?php
declare(strict_types=1);

return [
    'title' => 'Visit Array Positions to Maximize Score: best by parity',
    'leetcode' => 2786,
    'difficulty' => 'Med',
    'summary' => 'best[p] = best score ending on a number of parity p. For x: score = x + max(best[same parity], best[other parity] − x_penalty). Update best[parity of x].',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'visit-array-positions-to-maximize-score',
    'related_session' => 'visit-array-positions-to-maximize-score',
];
