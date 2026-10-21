<?php
declare(strict_types=1);

return [
    'title' => 'Making File Names Unique: next suffix per base name',
    'leetcode' => 1487,
    'difficulty' => 'Med',
    'summary' => 'Keep a map from each used name to the next suffix to try. For a taken name, try name(k) from the stored k upward, take the first free one, and record both names.',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Table',
    'topic' => 'LeetCode · Hash Table',
    'kind' => 'algo',
    'tags' => ['hash-table', 'strings', 'leetcode'],
    'related_session' => 'making-file-names-unique',
];
