<?php
declare(strict_types=1);

return [
    'title' => 'Count Fertile Pyramids: height from the three cells below',
    'leetcode' => 2088,
    'difficulty' => 'Hard',
    'summary' => 'h[r][c] = tallest pyramid with apex (r, c) = 1 + min(h of the three cells below) for fertile cells. Pyramids there: h − 1 (height at least 2). Do the same upside-down for inverse pyramids.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'count-fertile-pyramids-in-a-land',
    'related_session' => 'count-fertile-pyramids-in-a-land',
];
