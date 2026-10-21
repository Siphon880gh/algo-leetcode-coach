<?php
declare(strict_types=1);

return [
    'title' => 'Sentence Screen Fitting: walk joined sentence, back up mid-word',
    'leetcode' => 418,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: count how many times a word list fits on a rows by cols screen. Join with a trailing space, then each row adds cols to a cursor on that repeating string. Land on a space: consume it. Land inside a word: back up to the prior space. cursor / length is the count. ["hello","world"] 2×8 → 1. Not 68. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Strings',
    'topic' => 'LeetCode · Strings',
    'tags' => ['strings', 'simulation', 'step-by-step'],
    'related_guide' => 'sentence-screen-fitting',
];
