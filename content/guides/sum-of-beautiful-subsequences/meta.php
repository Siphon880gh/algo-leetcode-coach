<?php
declare(strict_types=1);

return [
    'title' => 'Sum of Beautiful Subsequences: count per divisor, then subtract multiples',
    'leetcode' => 3671,
    'difficulty' => 'Hard',
    'summary' => 'cnt[g] = strictly increasing subsequences using only multiples of g, counted with a Fenwick tree over those values in index order. exact[g] = cnt[g] − Σ exact[multiples of g]; answer Σ g · exact[g].',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Indexed Tree',
    'topic' => 'LeetCode · Binary Indexed Tree',
    'kind' => 'algo',
    'tags' => ['binary-indexed-tree', 'array', 'math', 'number-theory', 'leetcode'],
    'related_session' => 'sum-of-beautiful-subsequences',
];
