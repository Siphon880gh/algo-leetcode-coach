<?php
declare(strict_types=1);

return [
    'title' => 'Smallest Good Base: try digit counts',
    'leetcode' => 483,
    'difficulty' => 'Hard',
    'summary' => 'With m + 1 ones, n = 1 + k + … + k to the power m, so k about n to the power (1 divided by m). Try m from largest to smallest; check k = (n to the power (1 divided by m), rounded down) exactly with BigInt. m = 1 gives k = n − 1.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'tags' => ['binary-search', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'smallest-good-base',
    'related_session' => 'smallest-good-base',
];
