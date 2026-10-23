<?php
declare(strict_types=1);

return [
    'title' => 'Design a Text Editor',
    'leetcode' => 2296,
    'difficulty' => 'Hard',
    'summary' => 'Two stacks: text left of the cursor and text right of it (reversed). addText pushes left; deleteText pops left; moving the cursor shifts characters between stacks. Cursor moves return the last min(10, len) characters on the left.',
    'category' => 'LeetCode',
    'subcategory' => 'Design',
    'topic' => 'LeetCode · Design',
    'tags' => ['design', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'design-a-text-editor',
    'related_session' => 'design-a-text-editor',
];
