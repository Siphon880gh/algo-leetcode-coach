<?php
declare(strict_types=1);

return [
    'title' => 'Throttle: run now, then once per window with the latest arguments',
    'leetcode' => 2676,
    'difficulty' => 'Med',
    'summary' => 'Keep a timer for the current window and the latest pending arguments. Idle: run at once and start the timer. Busy: overwrite the pending arguments. When the timer fires, run the pending call and restart the timer, or go idle.',
    'category' => 'LeetCode',
    'subcategory' => 'JavaScript',
    'topic' => 'LeetCode · JavaScript',
    'kind' => 'algo',
    'tags' => ['javascript', 'leetcode'],
    'related_session' => 'throttle',
];
