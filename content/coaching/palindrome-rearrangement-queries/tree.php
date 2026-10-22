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
            'message' => "Read the problem statement above.\nCompare the first half with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The reversed second half', 'next' => 's2'],
                ['label' => 'The second half as it is', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. A palindrome mirrors position i with n − 1 − i; example 3 → false instead of true.\nStep back to when you skipped the reversal.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A mismatch outside both ranges?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Ignore it', 'next' => 'wrong_b'],
                ['label' => 'Answer false', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Nothing can fix it; bbabba with query [1, 1, 4, 4] → true instead of false.\nStep back to when you ignored it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(26 (n + q)). Examples → [true, true], [false], [true].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
