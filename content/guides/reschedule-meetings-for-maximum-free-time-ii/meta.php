<?php
declare(strict_types=1);

return [
    'title' => 'Reschedule Meetings for Maximum Free Time II: move one meeting out if it fits',
    'leetcode' => 3440,
    'difficulty' => 'Med',
    'summary' => 'Taking meeting i away joins its two side gaps. If some other gap, not touching i, can hold it, the meeting’s own length joins the free time too. Prefix and suffix maxima of the gaps answer that in O(1).',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'array', 'enumeration', 'leetcode'],
    'related_session' => 'reschedule-meetings-for-maximum-free-time-ii',
];
