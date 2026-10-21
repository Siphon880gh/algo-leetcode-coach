<?php
declare(strict_types=1);

return [
    'title' => 'String Compression II: delete or keep a run',
    'leetcode' => 1531,
    'difficulty' => 'Hard',
    'summary' => 'f(i, k) = shortest encoding of s[i:] with k deletions left. Either delete s[i], or make s[i] the start of a run: scan forward, keeping chars equal to s[i] and deleting the others while k allows.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dp', 'strings', 'leetcode'],
    'related_session' => 'string-compression-ii',
];
