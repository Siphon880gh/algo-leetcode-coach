<?php
declare(strict_types=1);

return [
    'title' => 'Find Pattern in Infinite Stream I: streaming KMP',
    'leetcode' => 3023,
    'difficulty' => 'Med',
    'summary' => 'Build the KMP failure table of the pattern, then feed stream bits one by one; when the match length reaches the pattern length, return the current index minus that length plus 1.',
    'category' => 'LeetCode',
    'subcategory' => 'Strings',
    'topic' => 'LeetCode · Strings',
    'kind' => 'algo',
    'tags' => ['array', 'interactive', 'string-matching', 'sliding-window', 'hash-function', 'rolling-hash', 'leetcode'],
    'related_session' => 'find-pattern-in-infinite-stream-i',
];
