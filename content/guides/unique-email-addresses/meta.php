<?php
declare(strict_types=1);

return [
    'title' => 'Unique Email Addresses: normalize the local name',
    'leetcode' => 929,
    'difficulty' => 'Easy',
    'summary' => 'Split each address at "@". In the local name, drop everything from the first "+" and remove every "."; the domain stays as is. Count the distinct normalized addresses with a set.',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Table',
    'topic' => 'LeetCode · Hash Table',
    'kind' => 'algo',
    'tags' => ['hash-table', 'strings', 'leetcode'],
    'related_session' => 'unique-email-addresses',
];
