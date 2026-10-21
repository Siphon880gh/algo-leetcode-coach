<?php
declare(strict_types=1);

return [
    'title' => 'Game Play Analysis V: installs and day-1 retention',
    'leetcode' => 1097,
    'difficulty' => 'Hard',
    'summary' => 'Find each player\'s first date, left join Activity on the day after it, then group by install date: the row count is installs and the matched count divided by it is the retention.',
    'category' => 'LeetCode',
    'subcategory' => 'Database',
    'topic' => 'LeetCode · Database',
    'kind' => 'algo',
    'tags' => ['database', 'sql', 'leetcode'],
    'related_session' => 'game-play-analysis-v',
];
