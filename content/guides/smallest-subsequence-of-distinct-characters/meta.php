<?php
declare(strict_types=1);

return [
    'title' => 'Smallest Subsequence of Distinct Characters: greedy stack',
    'leetcode' => 1081,
    'difficulty' => 'Med',
    'summary' => 'Build the answer in a stack. Before pushing a new letter, pop larger letters from the top if they appear again later. Skip letters already in the stack.',
    'category' => 'LeetCode',
    'subcategory' => 'Stack',
    'topic' => 'LeetCode · Stack',
    'kind' => 'algo',
    'tags' => ['stack', 'monotonic-stack', 'greedy', 'strings', 'leetcode'],
    'related_session' => 'smallest-subsequence-of-distinct-characters',
];
