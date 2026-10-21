<?php
declare(strict_types=1);

return [
    'title' => 'Design a Text Editor: two stacks around the cursor',
    'leetcode' => 2296,
    'difficulty' => 'Hard',
    'summary' => 'Keep the text left of the cursor in one stack and the text right of it in another. Typing pushes left, delete pops left, moving shifts characters between the stacks, and the reply is the last up to 10 characters of the left stack.',
    'category' => 'LeetCode',
    'subcategory' => 'Design',
    'topic' => 'LeetCode · Design',
    'kind' => 'algo',
    'tags' => ['design', 'linked-list', 'stack', 'string', 'doubly-linked-list', 'simulation', 'leetcode'],
    'related_session' => 'design-a-text-editor',
];
