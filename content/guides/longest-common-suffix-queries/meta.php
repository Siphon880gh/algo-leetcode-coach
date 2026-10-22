<?php
declare(strict_types=1);

return [
    'title' => 'Longest Common Suffix Queries: trie of reversed words',
    'leetcode' => 3093,
    'difficulty' => 'Hard',
    'summary' => 'Insert each container word reversed into a trie, and store at every node (root included) the best index reaching it: shortest length, then earliest. A query walks its reversed letters as far as possible and returns that node’s index.',
    'category' => 'LeetCode',
    'subcategory' => 'Trie',
    'topic' => 'LeetCode · Trie',
    'kind' => 'algo',
    'tags' => ['array', 'string', 'trie', 'leetcode'],
    'related_session' => 'longest-common-suffix-queries',
];
