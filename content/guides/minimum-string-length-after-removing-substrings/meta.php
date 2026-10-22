<?php
declare(strict_types=1);

return [
    'title' => 'Minimum String Length After Removing Substrings: a stack',
    'leetcode' => 2696,
    'difficulty' => 'Easy',
    'summary' => 'Scan with a stack. If the incoming letter completes AB or CD with the top, pop instead of pushing; removals can then expose new pairs, which the stack handles automatically.',
    'category' => 'LeetCode',
    'subcategory' => 'Stack',
    'topic' => 'LeetCode · Stack',
    'kind' => 'algo',
    'tags' => ['stack', 'string', 'simulation', 'leetcode'],
    'related_session' => 'minimum-string-length-after-removing-substrings',
];
