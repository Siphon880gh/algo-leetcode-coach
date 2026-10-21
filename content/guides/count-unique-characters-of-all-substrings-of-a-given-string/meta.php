<?php
declare(strict_types=1);

return [
    'title' => 'Count Unique Characters of All Substrings: count each character\'s contribution',
    'leetcode' => 828,
    'difficulty' => 'Hard',
    'summary' => 'A character at index i is unique in a substring exactly when the substring includes i but neither the previous nor the next occurrence of the same letter. So it contributes (i − prev) · (next − i), and the answer is the sum.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'strings', 'math', 'leetcode'],
    'related_session' => 'count-unique-characters-of-all-substrings-of-a-given-string',
];
