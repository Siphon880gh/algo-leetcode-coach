<?php
declare(strict_types=1);

return [
    'title' => 'Restaurant Growth: daily totals, then a 7-row window',
    'leetcode' => 1321,
    'difficulty' => 'Med',
    'summary' => 'Several customers can visit on one day, so first total the amount per day. Then sum over the current and six previous days with a window and divide by 7, reporting only days that have six days before them.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'kind' => 'algo',
    'tags' => ['sql', 'window-functions', 'leetcode'],
    'related_session' => 'restaurant-growth',
];
