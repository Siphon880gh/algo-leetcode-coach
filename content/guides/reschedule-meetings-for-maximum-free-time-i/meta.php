<?php
declare(strict_types=1);

return [
    'title' => 'Reschedule Meetings for Maximum Free Time I: k + 1 neighboring gaps',
    'leetcode' => 3439,
    'difficulty' => 'Med',
    'summary' => 'List the n + 1 gaps (before the first meeting, between meetings, after the last). Moving k consecutive meetings to one side merges the k + 1 gaps around them, so the answer is the largest sum of k + 1 neighboring gaps.',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'kind' => 'algo',
    'tags' => ['greedy', 'array', 'sliding-window', 'leetcode'],
    'related_session' => 'reschedule-meetings-for-maximum-free-time-i',
];
