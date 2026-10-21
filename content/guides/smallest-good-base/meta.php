<?php
declare(strict_types=1);

return [
    'title' => 'Smallest Good Base: try digit counts from longest, solve for the base',
    'leetcode' => 483,
    'difficulty' => 'Hard',
    'summary' => 'n (3 to 1e18) in base k is all 1s: n = 1 + k + … + k^m. More digits means a smaller base, so try m from about 60 down to 2 and find k with that sum (k is close to n^(1/m); binary search or check floor of the root). First match is the answer; k = n − 1 ("11") always works. "13" → "3". "4681" → "8".',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'kind' => 'algo',
    'tags' => ['math', 'binary-search', 'leetcode'],
    'related_session' => 'smallest-good-base',
];
