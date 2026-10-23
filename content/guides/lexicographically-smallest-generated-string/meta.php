<?php
declare(strict_types=1);

return [
    'title' => 'Lexicographically Smallest Generated String: place T windows, fix F windows from the right',
    'leetcode' => 3474,
    'difficulty' => 'Hard',
    'summary' => 'Write str2 at every T start (conflict → empty). Fill the rest with a. Then, left to right, any F window that equals str2 gets its rightmost free position changed to b; with none free, return empty.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'string', 'string-matching', 'leetcode'],
    'related_session' => 'lexicographically-smallest-generated-string',
];
