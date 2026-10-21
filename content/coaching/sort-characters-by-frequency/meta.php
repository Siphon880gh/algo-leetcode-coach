<?php
declare(strict_types=1);

return [
    'title' => 'Sort Characters By Frequency: count, then emit by count descending',
    'leetcode' => 451,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: rebuild s with the most frequent characters first and copies of a character together. Count each character, sort the distinct ones by count (or bucket by count), and write each one count times. "tree" → "eert". "Aabb" → "bbAa". Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Table',
    'topic' => 'LeetCode · Hash Table',
    'tags' => ['hash-table', 'sorting', 'bucket-sort', 'strings', 'step-by-step'],
    'related_guide' => 'sort-characters-by-frequency',
];
