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
            'message' => "State:\na = \"cat\"\nb = \"cut\"\n\nTable borders:\ndp[0][j] = j (insert j letters into the empty string)\ndp[i][0] = i (delete i letters to reach the empty string)\n\nWhat is dp[1][1], for turning \"c\" into \"c\"?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '0, because the last letters match, so copy the diagonal', 'next' => 'after_match'],
                ['label' => '1, because you always pay for a replace', 'next' => 'w_match'],
            ],
        ],
        'w_match' => [
            'message' => "Wrong.\n\nBoth prefixes end in c. Matching letters need no edit, so carry over dp[0][0] = 0.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'after_match' => [
            'message' => "State:\nthe table so far:\n  \"\"  c  cu\nc  0   0   1\nca 1   1   ?\n\nThe cell for turning \"ca\" into \"cu\" has different last letters, a and u. What is its value?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1: replace a with u, on top of dp[1][1] = 0', 'next' => 'ask_full'],
                ['label' => '2: one insert plus one delete', 'next' => 'w_diff'],
            ],
        ],
        'w_diff' => [
            'message' => "Wrong.\n\nThe cell is 1 plus the smallest of its three neighbors. The diagonal neighbor dp[1][1] is 0, so the value is 1 + 0 = 1.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'after_match',
            'choices' => [],
        ],
        'ask_full' => [
            'message' => "State:\nfull strings: turn \"cat\" into \"cut\"\nlook at the bottom-right cell\n\nWhat is the edit distance?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1, by replacing a with u', 'next' => 'success'],
                ['label' => '3, the length of "cat"', 'next' => 'w_len'],
            ],
        ],
        'w_len' => [
            'message' => "Wrong.\n\nThe length of a word is not the distance. One replace does the whole job.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'ask_full',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- The borders count pure inserts and pure deletes.\n- Matching letters copy the diagonal for free.\n- Different letters cost 1 plus the smallest of the three neighbors.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
