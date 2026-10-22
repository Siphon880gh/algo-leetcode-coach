<?php
declare(strict_types=1);

return [
    'title' => 'Remove Nodes From Linked List: keep a non-increasing stack',
    'leetcode' => 2487,
    'difficulty' => 'Med',
    'summary' => 'A node survives when no later value is larger, so the kept values never increase. Push nodes on a stack, popping any smaller top before pushing; the stack, linked in order, is the answer.',
    'category' => 'LeetCode',
    'subcategory' => 'Linked List',
    'topic' => 'LeetCode · Linked List',
    'kind' => 'algo',
    'tags' => ['linked-list', 'stack', 'recursion', 'monotonic-stack', 'leetcode'],
    'related_session' => 'remove-nodes-from-linked-list',
];
