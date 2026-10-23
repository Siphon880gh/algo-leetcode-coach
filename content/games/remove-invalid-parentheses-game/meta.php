<?php
declare(strict_types=1);

return [
    'title' => 'Remove Invalid Parentheses',
    'leetcode' => 301,
    'difficulty' => 'Hard',
    'summary' => 'BFS by number of removals: start with s; at each level remove one parenthesis from each string; the first level with any valid strings gives all answers (dedupe with a set).',
    'category' => 'LeetCode',
    'subcategory' => 'Backtracking',
    'topic' => 'LeetCode · Backtracking',
    'tags' => ['backtracking', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'remove-invalid-parentheses',
    'related_session' => 'remove-invalid-parentheses',
];
