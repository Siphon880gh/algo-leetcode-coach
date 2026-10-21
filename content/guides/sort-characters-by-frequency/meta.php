<?php
declare(strict_types=1);

return [
    'title' => 'Sort Characters By Frequency: count, then emit by count descending',
    'leetcode' => 451,
    'difficulty' => 'Med',
    'summary' => 'Rebuild s so characters with higher counts come first and equal characters stay together. Count each character, then sort the distinct characters by count (or bucket them by count) and write each one count times. "tree" → "eert" (or "eetr"). "Aabb" → "bbAa". Case matters. Not 347.',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Table',
    'topic' => 'LeetCode · Hash Table',
    'kind' => 'algo',
    'tags' => ['hash-table', 'sorting', 'bucket-sort', 'strings', 'leetcode'],
    'related_session' => 'sort-characters-by-frequency',
];
