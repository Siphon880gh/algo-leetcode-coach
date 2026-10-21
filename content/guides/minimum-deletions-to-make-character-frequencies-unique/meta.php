<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Deletions to Make Character Frequencies Unique: greedy decrement',
    'leetcode' => 1647,
    'difficulty' => 'Med',
    'summary' => 'Sort frequencies descending; for each, lower it until it is 0 or unused, counting each step as a deletion, then mark it used.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'hash-set', 'sorting', 'leetcode'],
    'related_session' => 'minimum-deletions-to-make-character-frequencies-unique',
];
