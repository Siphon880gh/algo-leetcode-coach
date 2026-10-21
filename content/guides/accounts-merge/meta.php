<?php
declare(strict_types=1);

return [
    'title' => 'Accounts Merge: union emails, then group by root',
    'leetcode' => 721,
    'difficulty' => 'Med',
    'summary' => 'Union every email in an account with that account\'s first email. Afterward, group emails by their union-find root, sort each group, and attach the name owned by the root.',
    'category' => 'LeetCode',
    'subcategory' => 'Union Find',
    'topic' => 'LeetCode · Union Find',
    'kind' => 'algo',
    'tags' => ['union-find', 'graphs', 'dfs', 'hash-map', 'sorting', 'leetcode'],
    'related_session' => 'accounts-merge',
];
