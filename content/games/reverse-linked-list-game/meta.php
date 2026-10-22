<?php
declare(strict_types=1);

return [
    'title' => 'Reverse Linked List: save, flip, advance',
    'leetcode' => 206,
    'difficulty' => 'Easy',
    'summary' => 'For each node: save next = curr.next, point curr.next back at prev, then move prev = curr and curr = next. Flipping before saving loses the rest of the list.',
    'category' => 'LeetCode',
    'subcategory' => 'Linked List',
    'topic' => 'LeetCode · Linked List',
    'tags' => ['linked-list', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'reverse-linked-list',
    'related_session' => 'reverse-linked-list',
];
