<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Initial Energy: sort by slack',
    'leetcode' => 1665,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: tasks with larger minimum − actual should be done first; build the answer from the last task backwards with e = max(minimum, e + actual). Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'related_guide' => 'minimum-initial-energy-to-finish-tasks',
    'tags' => ['greedy', 'sorting', 'step-by-step'],
];
