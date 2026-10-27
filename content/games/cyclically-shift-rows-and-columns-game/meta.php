<?php
declare(strict_types=1);

return [
    'title' => 'Cyclically Shift Rows and Columns',
    'leetcode' => 4052,
    'difficulty' => 'Easy',
    'summary' => 'Shift the rows first: after a left shift by k, the new row[j] is the old row[(j + k) % n]. Then shift each column up: the new column[i] is the old column[(i + k) % n].',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'tags' => ['grid', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'cyclically-shift-rows-and-columns',
    'related_session' => 'cyclically-shift-rows-and-columns',
];
