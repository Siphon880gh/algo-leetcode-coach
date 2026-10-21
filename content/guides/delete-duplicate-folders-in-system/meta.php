<?php
declare(strict_types=1);

return [
    'title' => 'Delete Duplicate Folders in System: serialise subtrees',
    'leetcode' => 1948,
    'difficulty' => 'Hard',
    'summary' => 'Build a trie of folders. Serialise each non-empty subtree canonically (sorted children with nested structure) and count serialisations. Then walk the trie again, skipping any folder whose serialisation appears more than once.',
    'category' => 'LeetCode',
    'subcategory' => 'Trie',
    'topic' => 'LeetCode · Trie',
    'kind' => 'algo',
    'tags' => ['trie', 'hash-table', 'string', 'dfs', 'leetcode'],
    'related_session' => 'delete-duplicate-folders-in-system',
];
