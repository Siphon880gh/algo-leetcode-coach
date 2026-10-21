<?php
declare(strict_types=1);

return [
    'title' => 'Unique Substrings in Wraparound String: longest run ending at each letter',
    'leetcode' => 467,
    'difficulty' => 'Med',
    'summary' => 'Count distinct substrings of s that appear in …xyzabc… (each next letter is the previous + 1, z wraps to a). A valid substring is fixed by its last letter and its length. Track the current run length k; for each letter c keep the longest run ending in c. Sum those 26 maxima. "zab" → 6. "cac" → 2. Not 3.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'strings', 'leetcode'],
    'related_session' => 'unique-substrings-in-wraparound-string',
];
