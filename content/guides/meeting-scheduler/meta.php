<?php
declare(strict_types=1);

return [
    'title' => 'Meeting Scheduler: two pointers over sorted slots',
    'leetcode' => 1229,
    'difficulty' => 'Med',
    'summary' => 'Sort both lists by start and walk them with two pointers. The overlap of the current pair runs from the later start to the earlier end; if it is at least duration long, answer there, otherwise advance the slot that ends first.',
    'category' => 'LeetCode',
    'subcategory' => 'Two Pointers',
    'topic' => 'LeetCode · Two Pointers',
    'kind' => 'algo',
    'tags' => ['two-pointers', 'sorting', 'intervals', 'leetcode'],
    'related_session' => 'meeting-scheduler',
];
