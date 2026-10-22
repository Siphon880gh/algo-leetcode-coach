<?php
declare(strict_types=1);

return [
    'title' => 'Remove Linked List Elements: a dummy head makes it uniform',
    'leetcode' => 203,
    'difficulty' => 'Easy',
    'summary' => 'Start curr at a dummy node before head. If curr.next.val == val, unlink it and stay; otherwise advance. The dummy means removing the real head is no special case.',
    'category' => 'LeetCode',
    'subcategory' => 'Linked List',
    'topic' => 'LeetCode · Linked List',
    'tags' => ['linked-list', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'remove-linked-list-elements',
    'related_session' => 'remove-linked-list-elements',
];
