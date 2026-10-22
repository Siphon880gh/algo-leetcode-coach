<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Cost to Convert String II: shortest paths per length, then a DP',
    'leetcode' => 2977,
    'difficulty' => 'Hard',
    'summary' => 'Rules convert whole strings, so treat each distinct string as a node and run Floyd–Warshall among strings of the same length. Then dp[i] = cheapest cost to fix the first i characters, extending by equal characters or by a converted piece.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['graph', 'trie', 'array', 'string', 'dynamic-programming', 'shortest-path', 'leetcode'],
    'related_session' => 'minimum-cost-to-convert-string-ii',
];
