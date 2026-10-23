<?php
declare(strict_types=1);

return [
    'title' => 'Smallest Good Base: try digit counts',
    'leetcode' => 483,
    'difficulty' => 'Hard',
    'summary' => 'With m + 1 ones, n = 1 + k + … + k^m, so k ≈ n^(1/m). Try m from largest to smallest; check k = ⌊n^(1/m)⌋ exactly with BigInt. m = 1 gives k = n − 1.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'tags' => ['binary-search', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'smallest-good-base',
    'related_session' => 'smallest-good-base',
];
