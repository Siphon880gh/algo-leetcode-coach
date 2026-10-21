<?php
declare(strict_types=1);

return [
    'title' => 'Design In-Memory File System: a trie of path parts',
    'leetcode' => 588,
    'difficulty' => 'Hard',
    'summary' => 'Store the file system as a trie keyed by path components. Each node has children, an is_file flag, and content. ls on a file returns its name; on a directory it returns the sorted child names.',
    'category' => 'LeetCode',
    'subcategory' => 'Design',
    'topic' => 'LeetCode · Design',
    'kind' => 'algo',
    'tags' => ['design', 'trie', 'hash-table', 'strings', 'leetcode'],
    'related_session' => 'design-in-memory-file-system',
];
