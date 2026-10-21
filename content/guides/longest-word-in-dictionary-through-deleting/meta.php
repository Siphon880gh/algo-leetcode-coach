<?php
declare(strict_types=1);

return [
    'title' => 'Longest Word in Dictionary through Deleting: two-pointer subsequence check per word',
    'leetcode' => 524,
    'difficulty' => 'Med',
    'summary' => 'Return the longest dictionary word that is a subsequence of s, breaking ties by the lexicographically smallest word; "" if none. For each word, run a two-pointer subsequence check on s, and keep it if it is longer, or the same length and smaller. "abpcplea", ["ale","apple","monkey","plea"] → "apple".',
    'category' => 'LeetCode',
    'subcategory' => 'Two Pointers',
    'topic' => 'LeetCode · Two Pointers',
    'kind' => 'algo',
    'tags' => ['two-pointers', 'strings', 'sorting', 'leetcode'],
    'related_session' => 'longest-word-in-dictionary-through-deleting',
];
