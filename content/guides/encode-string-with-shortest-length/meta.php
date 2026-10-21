<?php
declare(strict_types=1);

return [
    'title' => 'Encode String with Shortest Length: interval DP with repeat detection',
    'leetcode' => 471,
    'difficulty' => 'Hard',
    'summary' => 'Encode s using k[sub] so the result is shortest; never encode when it does not save length. f[i][j] = shortest encoding of s[i..j]. Try every split f[i][k] + f[k+1][j]. Also, if s[i..j] is a repeat of its first p characters (find s[i..j] in doubled string), try count[f[i][i+p−1]]. Strings shorter than 5 stay as they are. "aaaaa" → "5[a]".',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'strings', 'interval-dp', 'leetcode'],
    'related_session' => 'encode-string-with-shortest-length',
];
