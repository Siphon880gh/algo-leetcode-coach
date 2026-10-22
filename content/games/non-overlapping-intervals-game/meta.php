<?php
declare(strict_types=1);

return [
    'title' => 'Non-overlapping Intervals: keep the earliest end',
    'leetcode' => 435,
    'difficulty' => 'Med',
    'summary' => 'Sort by END time. Keep an interval whenever it starts at or after the last kept end; otherwise remove it. Ending early leaves the most room for the rest.',
    'category' => 'LeetCode',
    'subcategory' => 'Intervals',
    'topic' => 'LeetCode · Intervals',
    'tags' => ['intervals', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'non-overlapping-intervals',
    'related_session' => 'non-overlapping-intervals',
];
