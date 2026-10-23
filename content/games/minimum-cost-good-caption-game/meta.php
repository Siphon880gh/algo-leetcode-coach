<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Cost Good Caption: runs of at least 3',
    'leetcode' => 3441,
    'difficulty' => 'Hard',
    'summary' => 'dp from the right: each block of ≥ 3 equal letters costs Σ |caption[i] − letter|. Tie-break toward the lexicographically smallest result. Here: try every good caption over the nearby letters.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-cost-good-caption',
    'related_session' => 'minimum-cost-good-caption',
];
