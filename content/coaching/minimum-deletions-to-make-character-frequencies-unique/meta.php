<?php
declare(strict_types=1);

return [
    'title' => 'Unique Character Frequencies: push collisions down',
    'leetcode' => 1647,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: sort counts descending; lower each until it is unused or zero, counting deletions; mark it used. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'related_guide' => 'minimum-deletions-to-make-character-frequencies-unique',
    'tags' => ['greedy', 'hash-set', 'sorting', 'step-by-step'],
];
