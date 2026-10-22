<?php
declare(strict_types=1);

return [
    'title' => 'Frequency Tracker: skip missing deletes, read one bucket',
    'leetcode' => 2671,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: deleting a number that is not present changes nothing, and hasFrequency reads one bucket instead of scanning. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Design',
    'topic' => 'LeetCode · Design',
    'related_guide' => 'frequency-tracker',
    'tags' => ['design', 'hash-table', 'step-by-step'],
];
