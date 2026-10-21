<?php
declare(strict_types=1);

return [
    'title' => 'Number of Valid Words in a Sentence: check each token',
    'leetcode' => 2047,
    'difficulty' => 'Easy',
    'summary' => 'Split on spaces and validate each token: no digits, at most one hyphen with letters on both sides, at most one punctuation mark and only at the end. A regex like ^([a-z]+(-[a-z]+)?)?[!.,]?$ captures all three rules.',
    'category' => 'LeetCode',
    'subcategory' => 'String',
    'topic' => 'LeetCode · String',
    'kind' => 'algo',
    'tags' => ['string', 'leetcode'],
    'related_session' => 'number-of-valid-words-in-a-sentence',
];
