<?php
declare(strict_types=1);

return [
    'title' => 'Synonymous Sentences: groups and all choices',
    'leetcode' => 1258,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: union synonyms into groups, sort each group, backtrack over the sentence choosing any member for grouped words, and sort the result. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Backtracking',
    'topic' => 'LeetCode · Backtracking',
    'related_guide' => 'synonymous-sentences',
    'tags' => ['backtracking', 'union-find', 'strings', 'step-by-step'],
];
