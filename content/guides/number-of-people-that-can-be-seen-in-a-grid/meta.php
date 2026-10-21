<?php
declare(strict_types=1);

return [
    'title' => 'Number of People That Can Be Seen in a Grid: monotonic stack per row and column',
    'leetcode' => 2282,
    'difficulty' => 'Med',
    'summary' => 'Scan each row from the right (and each column from the bottom) with a decreasing stack of heights. Pop and count every shorter height, count one more if a taller-or-equal one remains, then pop an equal height so it does not block twice; push the current height.',
    'category' => 'LeetCode',
    'subcategory' => 'Monotonic Stack',
    'topic' => 'LeetCode · Monotonic Stack',
    'kind' => 'algo',
    'tags' => ['array', 'stack', 'matrix', 'monotonic-stack', 'leetcode'],
    'related_session' => 'number-of-people-that-can-be-seen-in-a-grid',
];
