<?php
declare(strict_types=1);

return [
    'title' => 'Design Search Autocomplete System: a trie with counts',
    'leetcode' => 642,
    'difficulty' => 'Hard',
    'summary' => 'Store every sentence in a trie with its count. Keep a pointer to the node for the current prefix; on each character, step down and return the top 3 sentences under it by count, then ASCII. # saves the sentence.',
    'category' => 'LeetCode',
    'subcategory' => 'Design',
    'topic' => 'LeetCode · Design',
    'kind' => 'algo',
    'tags' => ['design', 'trie', 'heap', 'strings', 'leetcode'],
    'related_session' => 'design-search-autocomplete-system',
];
