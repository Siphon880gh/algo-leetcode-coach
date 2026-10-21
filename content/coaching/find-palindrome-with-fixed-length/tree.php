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
            'message' => "Read the problem statement above.\nFind the q-th palindrome?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'First half = 10^(h − 1) + q − 1', 'next' => 's2'],
                ['label' => 'List palindromes in order', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Length 15 has 9 · 10^7 palindromes, far too many to list per query.\nStep back to when you listed them.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "First half reaches 10^h?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Mirror it anyway', 'next' => 'wrong_b'],
                ['label' => 'Answer −1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Length 3, q = 91 would give a 5-digit number.\nStep back to when you skipped the bound.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Odd length mirror?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Leave out the middle digit', 'next' => 'success'],
                ['label' => 'Mirror all of the half', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Length 3, q = 1 would give 1001 instead of 101.\nStep back to when you mirrored the middle.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(len(queries) · L). Examples → [101,111,121,131,141,999], [1111,1331,1551].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
