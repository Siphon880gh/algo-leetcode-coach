<?php
declare(strict_types=1);

return [
    'title' => 'Lexicographically Smallest String After Adjacent Removals: interval DP',
    'leetcode' => 3563,
    'difficulty' => 'Hard',
    'summary' => 'can[i][j] says s[i:j] can vanish entirely: s[i] pairs with some s[k] that is next to it in the circular alphabet, with s[i + 1:k] and s[k + 1:j] both vanishing. Then best[i] = the smaller of s[i] + best[i + 1] and best[j] for every vanishing s[i:j].',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['string', 'dynamic-programming', 'leetcode'],
    'related_session' => 'lexicographically-smallest-string-after-adjacent-removals',
];
