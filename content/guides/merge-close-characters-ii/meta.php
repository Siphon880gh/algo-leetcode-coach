<?php
declare(strict_types=1);

return [
    'title' => 'Merge Close Characters II: one left-to-right pass',
    'leetcode' => 4019,
    'difficulty' => 'Med',
    'summary' => 'Merges always delete the right character, so the kept characters keep their positions in the result. Scan once: skip a character when the same letter was kept at most k positions earlier in the result, else keep it.',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Table',
    'topic' => 'LeetCode · Hash Table',
    'kind' => 'algo',
    'tags' => ['hash-table', 'string', 'leetcode'],
    'related_session' => 'merge-close-characters-ii',
];
