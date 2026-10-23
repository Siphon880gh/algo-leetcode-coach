<?php
declare(strict_types=1);

return [
    'title' => 'Design Event Manager: heap with lazy deletion',
    'leetcode' => 3885,
    'difficulty' => 'Med',
    'summary' => 'Keep the current priority of every active event in a map, and push (−priority, id) into a min-heap on every set. A poll pops until the top entry still matches the map.',
    'category' => 'LeetCode',
    'subcategory' => 'Design',
    'topic' => 'LeetCode · Design',
    'kind' => 'algo',
    'tags' => ['design', 'array', 'hash-table', 'ordered-set', 'heap', 'leetcode'],
    'related_session' => 'design-event-manager',
];
