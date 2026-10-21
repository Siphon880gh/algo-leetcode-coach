<?php
declare(strict_types=1);

return [
    'title' => 'Concatenated Words: word-break each word against the shorter words',
    'leetcode' => 472,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: return every word made of at least two other words from the list. Sort by length; run Word Break on each word using only words already added (all shorter), then add it. ["cat","cats","catsdogcats","dog","dogcatsdog","hippopotamuses","rat","ratcatdogcat"] → 3 words. Not 139 alone. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dynamic-programming', 'trie', 'strings', 'step-by-step'],
    'related_guide' => 'concatenated-words',
];
