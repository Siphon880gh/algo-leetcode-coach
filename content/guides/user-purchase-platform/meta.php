<?php
declare(strict_types=1);

return [
    'title' => 'User Purchase Platform: classify each user-day, then fill the grid',
    'leetcode' => 1127,
    'difficulty' => 'Hard',
    'summary' => 'First collapse each (user, date) into one group: mobile, desktop, or both, with its total. Then build every (date, group) combination and left join the grouped totals so empty groups show zeros.',
    'category' => 'LeetCode',
    'subcategory' => 'Database',
    'topic' => 'LeetCode · Database',
    'kind' => 'algo',
    'tags' => ['database', 'sql', 'leetcode'],
    'related_session' => 'user-purchase-platform',
];
