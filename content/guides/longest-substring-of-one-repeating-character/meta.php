<?php
declare(strict_types=1);

return [
    'title' => 'Longest Substring of One Repeating Character: segment tree of runs',
    'leetcode' => 2213,
    'difficulty' => 'Hard',
    'summary' => 'Each segment tree node keeps its length, longest prefix run, longest suffix run and best run. Merging joins the left suffix with the right prefix when the boundary characters match. Each query is a point update.',
    'category' => 'LeetCode',
    'subcategory' => 'Segment Tree',
    'topic' => 'LeetCode · Segment Tree',
    'kind' => 'algo',
    'tags' => ['array', 'string', 'segment-tree', 'ordered-set', 'leetcode'],
    'related_session' => 'longest-substring-of-one-repeating-character',
];
