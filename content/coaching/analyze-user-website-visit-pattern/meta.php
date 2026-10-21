<?php
declare(strict_types=1);

return [
    'title' => 'Analyze User Website Visit Pattern: per-user triple sets',
    'leetcode' => 1152,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: sort by time, group by user, build each user\'s set of ordered triples, count each pattern once per user, and pick the best with a tie-break. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Table',
    'topic' => 'LeetCode · Hash Table',
    'related_guide' => 'analyze-user-website-visit-pattern',
    'tags' => ['hash-table', 'sorting', 'combinations', 'step-by-step'],
];
