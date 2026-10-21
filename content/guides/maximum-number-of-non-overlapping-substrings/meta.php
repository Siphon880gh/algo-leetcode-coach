<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Number of Non-Overlapping Substrings: closed intervals, greedy by end',
    'leetcode' => 1520,
    'difficulty' => 'Hard',
    'summary' => 'For each character, expand [first, last] until it contains every occurrence of every character inside; discard it if expansion would reach left of its start. Then choose intervals greedily by earliest end.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'strings', 'intervals', 'leetcode'],
    'related_session' => 'maximum-number-of-non-overlapping-substrings',
];
