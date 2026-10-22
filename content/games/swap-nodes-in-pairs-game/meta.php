<?php
declare(strict_types=1);

return [
    'title' => 'Swap Nodes in Pairs: swap, then jump two',
    'leetcode' => 24,
    'difficulty' => 'Med',
    'summary' => 'With prev before the pair: prev.next = second, first.next = second.next, second.next = first. Then prev jumps to first (now second in the pair). Stop when fewer than two nodes remain.',
    'category' => 'LeetCode',
    'subcategory' => 'Linked List',
    'topic' => 'LeetCode · Linked List',
    'tags' => ['linked-list', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'swap-nodes-in-pairs',
    'related_session' => 'swap-nodes-in-pairs',
];
