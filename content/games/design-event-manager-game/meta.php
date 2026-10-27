<?php
declare(strict_types=1);

return [
    'title' => 'Design Event Manager',
    'leetcode' => 3885,
    'difficulty' => 'Med',
    'summary' => 'Keep eventId to current priority and a max-heap of (priority, −eventId). updatePriority pushes a fresh entry; pollHighest pops entries until it finds one that is still active with its current priority (lazy deletion).',
    'category' => 'LeetCode',
    'subcategory' => 'Design',
    'topic' => 'LeetCode · Design',
    'tags' => ['design', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'design-event-manager',
    'related_session' => 'design-event-manager',
];
