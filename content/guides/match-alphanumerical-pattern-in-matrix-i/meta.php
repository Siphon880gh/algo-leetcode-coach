<?php
declare(strict_types=1);

return [
    'title' => 'Match Alphanumerical Pattern in Matrix I: test every placement',
    'leetcode' => 3078,
    'difficulty' => 'Med',
    'summary' => 'Try every top-left cell. For each, walk the pattern: digits must match exactly, and keep two maps, letter → digit and digit → letter, so the same letter always means the same digit and different letters mean different digits.',
    'category' => 'LeetCode',
    'subcategory' => 'Matrix',
    'topic' => 'LeetCode · Matrix',
    'kind' => 'algo',
    'tags' => ['array', 'hash-table', 'string', 'matrix', 'leetcode'],
    'related_session' => 'match-alphanumerical-pattern-in-matrix-i',
];
