<?php
declare(strict_types=1);

return [
    'title' => 'Find Mirror Score of a String: a stack per letter',
    'leetcode' => 3412,
    'difficulty' => 'Med',
    'summary' => 'Keep a stack of unmarked indices for each letter. At index i, the closest unmarked mirror is the top of the mirror letter’s stack; pop it and add i − j, or push i if that stack is empty.',
    'category' => 'LeetCode',
    'subcategory' => 'Stack',
    'topic' => 'LeetCode · Stack',
    'kind' => 'algo',
    'tags' => ['stack', 'hash-table', 'string', 'simulation', 'leetcode'],
    'related_session' => 'find-mirror-score-of-a-string',
];
