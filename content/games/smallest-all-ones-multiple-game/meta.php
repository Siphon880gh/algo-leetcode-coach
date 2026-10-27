<?php
declare(strict_types=1);

return [
    'title' => 'Smallest All Ones Multiple',
    'leetcode' => 3790,
    'difficulty' => 'Med',
    'summary' => 'Never build the huge number: track only its remainder, r = (10r + 1) mod k, for lengths 1, 2, 3, …. Hitting 0 gives the length; there are only k remainders, so after k steps without 0 the answer is −1.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'tags' => ['math', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'smallest-all-ones-multiple',
    'related_session' => 'smallest-all-ones-multiple',
];
