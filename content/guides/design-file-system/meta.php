<?php
declare(strict_types=1);

return [
    'title' => 'Design File System: path map with a parent check',
    'leetcode' => 1166,
    'difficulty' => 'Med',
    'summary' => 'Keep a dictionary from full path to value. A create succeeds only if the path is new and its parent, the text before the last slash, is empty or already stored.',
    'category' => 'LeetCode',
    'subcategory' => 'Design',
    'topic' => 'LeetCode · Design',
    'kind' => 'algo',
    'tags' => ['design', 'hash-table', 'strings', 'leetcode'],
    'related_session' => 'design-file-system',
];
