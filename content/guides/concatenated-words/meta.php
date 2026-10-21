<?php
declare(strict_types=1);

return [
    'title' => 'Concatenated Words: word-break each word against the shorter words',
    'leetcode' => 472,
    'difficulty' => 'Hard',
    'summary' => 'Return every word made of at least two other words from the list (repeats allowed). Sort by length; for each word, run a word-break DP (or trie DFS) using only words already added, then add it. A word that breaks is concatenated. ["cat","cats","catsdogcats","dog","dogcatsdog","hippopotamuses","rat","ratcatdogcat"] → 3 words. Same core as 139.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'trie', 'strings', 'leetcode'],
    'related_session' => 'concatenated-words',
];
