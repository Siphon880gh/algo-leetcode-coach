<?php
declare(strict_types=1);

return [
    'title' => '4 Keys Keyboard: type, or copy once and paste the rest',
    'leetcode' => 651,
    'difficulty' => 'Med',
    'summary' => 'dp[i] is the most A\'s with i presses. The last press either types an A, or ends a run that did Ctrl-A, Ctrl-C at press j and pasted ever since, multiplying dp[j] by (i − j − 1).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'math', 'leetcode'],
    'related_session' => '4-keys-keyboard',
];
