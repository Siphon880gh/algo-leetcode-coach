<?php
declare(strict_types=1);

return [
    'title' => 'Find Array Given Subset Sums',
    'leetcode' => 1982,
    'difficulty' => 'Hard',
    'summary' => 'Sort sums; d = s[1] − s[0] is |some element|. Split the multiset into pairs (x, x + d). If the "without" half contains 0, the element is d; otherwise it is −d and the "with" half continues. Recurse n times.',
    'category' => 'LeetCode',
    'subcategory' => 'Sorting',
    'topic' => 'LeetCode · Sorting',
    'tags' => ['sorting', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'find-array-given-subset-sums',
    'related_session' => 'find-array-given-subset-sums',
];
