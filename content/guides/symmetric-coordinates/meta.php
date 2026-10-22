<?php
declare(strict_types=1);

return [
    'title' => 'Symmetric Coordinates: self-join on swapped values, distinct rows',
    'leetcode' => 2978,
    'difficulty' => 'Med',
    'summary' => 'Join the table to itself on a.X = b.Y and a.Y = b.X, but require two different rows, so a point like (5, 5) only counts when it appears twice. Keep X ≤ Y and remove duplicates.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'kind' => 'algo',
    'tags' => ['database', 'leetcode'],
    'related_session' => 'symmetric-coordinates',
];
