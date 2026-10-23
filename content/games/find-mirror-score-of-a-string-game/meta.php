<?php
declare(strict_types=1);

return [
    'title' => 'Find Mirror Score of a String',
    'leetcode' => 3412,
    'difficulty' => 'Med',
    'summary' => 'Keep a stack of unmarked indices per letter. At index i, if the stack for mirror(s[i]) is non-empty, pop j and add i − j; otherwise push i onto s[i]\'s stack.',
    'category' => 'LeetCode',
    'subcategory' => 'Stack',
    'topic' => 'LeetCode · Stack',
    'tags' => ['stack', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'find-mirror-score-of-a-string',
    'related_session' => 'find-mirror-score-of-a-string',
];
