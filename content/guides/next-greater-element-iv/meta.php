<?php
declare(strict_types=1);

return [
    'title' => 'Next Greater Element IV: two monotonic stacks',
    'leetcode' => 2454,
    'difficulty' => 'Hard',
    'summary' => 'Keep one stack of indices still waiting for a first greater value and one for those waiting for a second. Each new value first settles entries in the second stack, then moves the smaller entries of the first stack over, in order.',
    'category' => 'LeetCode',
    'subcategory' => 'Stack',
    'topic' => 'LeetCode · Stack',
    'kind' => 'algo',
    'tags' => ['array', 'binary-search', 'stack', 'sorting', 'heap', 'monotonic-stack', 'leetcode'],
    'related_session' => 'next-greater-element-iv',
];
