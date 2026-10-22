<?php
declare(strict_types=1);

return [
    'title' => 'Find the Lexicographically Smallest Valid Sequence: suffix match lengths, then greedy',
    'leetcode' => 3302,
    'difficulty' => 'Med',
    'summary' => 'suf[i] = how much of word2’s tail can be matched as a subsequence of word1[i…]. Scan left to right: take matching characters; spend the one change at the first index where the rest can still be finished.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'two-pointers', 'string', 'dynamic-programming', 'leetcode'],
    'related_session' => 'find-the-lexicographically-smallest-valid-sequence',
];
