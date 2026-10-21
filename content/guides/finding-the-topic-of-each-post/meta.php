<?php
declare(strict_types=1);

return [
    'title' => 'Finding the Topic of Each Post: whole-word matches per post',
    'leetcode' => 2199,
    'difficulty' => 'Hard',
    'summary' => 'Pad the lowercased content and each lowercased keyword with spaces and match with LIKE, so only whole words count. Group by post, concatenate distinct topic ids in order, and fall back to Ambiguous! when nothing matched.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'kind' => 'algo',
    'tags' => ['database', 'sql', 'leetcode'],
    'related_session' => 'finding-the-topic-of-each-post',
];
