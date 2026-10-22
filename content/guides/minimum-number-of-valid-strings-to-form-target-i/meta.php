<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Number of Valid Strings to Form Target I: reach, then jump game',
    'leetcode' => 3291,
    'difficulty' => 'Med',
    'summary' => 'Any prefix of a valid string is valid, so from i every end up to reach[i] works. Get reach[i] by walking a trie of the words, then solve a jump game greedily.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['greedy', 'trie', 'array', 'string', 'dynamic-programming', 'leetcode'],
    'related_session' => 'minimum-number-of-valid-strings-to-form-target-i',
];
