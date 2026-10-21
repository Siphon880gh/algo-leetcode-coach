<?php
declare(strict_types=1);

return [
    'title' => 'Distinct Subsequences II: count by last character',
    'leetcode' => 940,
    'difficulty' => 'Hard',
    'summary' => 'Let end[c] be the number of distinct subsequences ending in letter c. Reading c, every existing subsequence (and the empty one) can be extended by c, so end[c] = sum(end) + 1; old ones ending in c are replaced, not added.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'strings', 'leetcode'],
    'related_session' => 'distinct-subsequences-ii',
];
