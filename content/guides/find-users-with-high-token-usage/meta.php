<?php
declare(strict_types=1);

return [
    'title' => 'Find Users with High Token Usage: aggregate, then filter',
    'leetcode' => 3793,
    'difficulty' => 'Easy',
    'summary' => 'Group by user for the count, average and maximum. Keep users with at least 3 prompts whose maximum beats their average, since some prompt is above the average exactly when the maximum is.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'kind' => 'algo',
    'tags' => ['database', 'leetcode'],
    'related_session' => 'find-users-with-high-token-usage',
];
