<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Valid Split Positions II',
    'leetcode' => 4037,
    'difficulty' => 'Hard',
    'summary' => 'n is 10^5, so recomputing per removal is too slow. A split is valid when both sides have gcd G (the remaining array\'s gcd). Prefix gcds take only O(log) distinct values, so for each removed index, combine precomputed prefix gcds before it, suffix gcds after it, and counts of positions where they equal the new G, all from prefix/suffix arrays and gcd-run boundaries.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'tags' => ['math', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-valid-split-positions-ii',
    'related_session' => 'maximum-valid-split-positions-ii',
];
