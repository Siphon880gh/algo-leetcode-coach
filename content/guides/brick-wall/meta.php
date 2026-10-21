<?php
declare(strict_types=1);

return [
    'title' => 'Brick Wall: count edge positions, cross the most edges',
    'leetcode' => 554,
    'difficulty' => 'Med',
    'summary' => 'Draw a vertical line top to bottom crossing as few bricks as possible (not along the outer edges). For each row, record the prefix sums of brick widths, excluding the last (the wall edge), in a counter. The best line passes the most common edge: answer = rows − max count. Example → 2.',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Table',
    'topic' => 'LeetCode · Hash Table',
    'kind' => 'algo',
    'tags' => ['hash-table', 'arrays', 'prefix-sum', 'leetcode'],
    'related_session' => 'brick-wall',
];
