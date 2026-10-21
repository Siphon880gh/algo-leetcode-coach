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
            'message' => "Read the problem statement above.\nWhat about the first column?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Flip rows so every row starts with 1', 'next' => 's2'],
                ['label' => 'Leave it as it is', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The leading bit outweighs all lower bits combined.\nStep back to when you left it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "And the other columns?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Flip more rows', 'next' => 'wrong_b'],
                ['label' => 'Flip a column if its 0s outnumber its 1s', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Row flips now would undo the leading 1s.\nStep back to when you flipped rows.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How do you compute the score?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sum max(ones, m − ones) · 2^(n − 1 − j) over columns', 'next' => 'success'],
                ['label' => 'Count the total number of 1s', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Bits in different columns have different weights.\nStep back to when you counted ones.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m · n). [[0,0,1,1],[1,0,1,0],[1,1,0,0]] → 39. [[0]] → 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
