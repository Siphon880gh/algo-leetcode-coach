<?php
declare(strict_types=1);

return [
    'title' => 'Check if Grid can be Cut into Sections: merge intervals on each axis',
    'leetcode' => 3394,
    'difficulty' => 'Med',
    'summary' => 'Project the rectangles onto the x axis and onto the y axis. A cut fits between sorted intervals when the next start is at least the largest end so far. Two such gaps on either axis means three sections.',
    'category' => 'LeetCode',
    'subcategory' => 'Sorting',
    'topic' => 'LeetCode · Sorting',
    'kind' => 'algo',
    'tags' => ['array', 'sorting', 'leetcode'],
    'related_session' => 'check-if-grid-can-be-cut-into-sections',
];
