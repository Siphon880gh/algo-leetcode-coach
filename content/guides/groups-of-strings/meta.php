<?php
declare(strict_types=1);

return [
    'title' => 'Groups of Strings: union-find on masks with wildcards',
    'leetcode' => 2157,
    'difficulty' => 'Hard',
    'summary' => 'Each word is a letter mask. Two words connect if one mask equals the other minus a letter (add/delete), or both become equal after deleting one letter each (replace). Union every word with the masks it reaches by deleting one letter, using a separate wildcard key for replacement.',
    'category' => 'LeetCode',
    'subcategory' => 'Union Find',
    'topic' => 'LeetCode · Union Find',
    'kind' => 'algo',
    'tags' => ['union-find', 'bit-manipulation', 'hash-table', 'leetcode'],
    'related_session' => 'groups-of-strings',
];
