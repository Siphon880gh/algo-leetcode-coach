<?php
declare(strict_types=1);

/**
 * Step-by-step tree contract:
 * - start: node id
 * - nodes[id]: message, outcome (continue|wrong|success), choices[{label, next}], optional rewind_to on wrong
 */
return [
    'start' => 'start',
    'nodes' => [
        'start' => [
            'message' => 'State:
a = "cat"
b = "cut"

Empty table borders:
dp[0][j] = j  (insert j letters into "")
dp[i][0] = i  (delete i letters to get "")

What is dp[1][1] for prefixes "c" → "c"?',
            'outcome' => 'continue',
            'choices' => [
                ['label' => '0 — last letters match, copy diagonal', 'next' => 'after_match'],
                ['label' => '1 — always pay a replace', 'next' => 'w_match'],
            ],
        ],
        'w_match' => [
            'message' => 'Wrong.

Both prefixes end in c. Matching letters need no edit — carry dp[0][0]=0.

Step back.',
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'after_match' => [
            'message' => 'State:
dp so far:
  ""  c  cu
c  0   0   1
ca 1   1   ?

Cell for "ca" → "cu" (last letters a vs u differ). Value?',
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1 — replace a→u on top of dp[1][1]=0', 'next' => 'ask_full'],
                ['label' => '2 — insert and delete both', 'next' => 'w_diff'],
            ],
        ],
        'w_diff' => [
            'message' => 'Wrong.

1 + min(insert=dp[2][1]+…, delete=dp[1][2]+…, replace=dp[1][1]) = 1 + 0 = 1.

Step back.',
            'outcome' => 'wrong',
            'rewind_to' => 'after_match',
            'choices' => [],
        ],
        'ask_full' => [
            'message' => 'State:
full strings cat → cut
bottom-right of the table

Edit distance?',
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1 — only replace a with u', 'next' => 'success'],
                ['label' => '3 — length of cat', 'next' => 'w_len'],
            ],
        ],
        'w_len' => [
            'message' => 'Wrong.

Length is not distance. One replace finishes the job.

Step back.',
            'outcome' => 'wrong',
            'rewind_to' => 'ask_full',
            'choices' => [],
        ],
        'success' => [
            'message' => 'Correct.

- Borders = pure inserts/deletes
- Match → free diagonal
- Differ → 1 + min of three neighbors

You finished this path.',
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
