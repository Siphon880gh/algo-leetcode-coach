<?php
declare(strict_types=1);

return [
    'title' => 'Brace Expansion: parse groups, then take the product',
    'leetcode' => 1087,
    'difficulty' => 'Med',
    'summary' => 'Split s into a list of choice lists: a plain letter is a list of one, a brace group is its sorted options. Build words by DFS over the positions; visiting options in sorted order yields the output already sorted.',
    'category' => 'LeetCode',
    'subcategory' => 'Backtracking',
    'topic' => 'LeetCode · Backtracking',
    'kind' => 'algo',
    'tags' => ['backtracking', 'strings', 'leetcode'],
    'related_session' => 'brace-expansion',
];
