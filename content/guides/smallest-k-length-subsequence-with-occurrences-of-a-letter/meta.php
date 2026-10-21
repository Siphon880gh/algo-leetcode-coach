<?php
declare(strict_types=1);

return [
    'title' => 'Smallest K-Length Subsequence With Occurrences of a Letter: guarded monotonic stack',
    'leetcode' => 2030,
    'difficulty' => 'Hard',
    'summary' => 'Build the answer with a monotonic stack. Pop a larger top only if enough characters remain to reach length k and, when the top is the letter, enough letters remain to still meet repetition. Push a non-letter only if there is room left beyond the letters still required.',
    'category' => 'LeetCode',
    'subcategory' => 'Monotonic Stack',
    'topic' => 'LeetCode · Monotonic Stack',
    'kind' => 'algo',
    'tags' => ['monotonic-stack', 'greedy', 'string', 'leetcode'],
    'related_session' => 'smallest-k-length-subsequence-with-occurrences-of-a-letter',
];
