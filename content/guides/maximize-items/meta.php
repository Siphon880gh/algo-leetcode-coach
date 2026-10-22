<?php
declare(strict_types=1);

return [
    'title' => 'Maximize Items: fill with one item set, then the other',
    'leetcode' => 3052,
    'difficulty' => 'Hard',
    'summary' => 'Group by type to get each set’s item count and total area. Copies of the priority set = floor(capacity / its area); copies of the other set = floor((capacity − used) / its area). Multiply each by its item count.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'kind' => 'algo',
    'tags' => ['database', 'leetcode'],
    'related_session' => 'maximize-items',
];
