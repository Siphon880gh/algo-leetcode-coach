<?php
declare(strict_types=1);

return [
    'title' => 'Strange Printer: interval DP that merges equal ends',
    'leetcode' => 664,
    'difficulty' => 'Hard',
    'summary' => 'f[i][j] is the fewest turns to print s[i..j]. If s[i] == s[j], the last character comes free with the first turn; otherwise split at the best k.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'interval-dp', 'strings', 'leetcode'],
    'related_session' => 'strange-printer',
];
