<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Points in an Archery Competition: try every set of sections',
    'leetcode' => 2212,
    'difficulty' => 'Med',
    'summary' => 'Only 12 sections, so try all 2^12 subsets Bob wins. Winning section k costs aliceArrows[k] + 1 arrows; keep the best affordable subset and dump spare arrows anywhere (for example section 0).',
    'category' => 'LeetCode',
    'subcategory' => 'Enumeration',
    'topic' => 'LeetCode · Enumeration',
    'kind' => 'algo',
    'tags' => ['array', 'backtracking', 'bit-manipulation', 'enumeration', 'leetcode'],
    'related_session' => 'maximum-points-in-an-archery-competition',
];
