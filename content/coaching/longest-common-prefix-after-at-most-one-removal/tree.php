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
            'message' => "Problem: Given strings s and t, you may delete at most one character from s. Return the length of the longest common prefix of the result and t. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nFirst mismatch?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Skip that character of s', 'next' => 's2'],
                ['label' => 'Stop', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. abxcd, abcde → 2 instead of 4.\nStep back to when you stopped.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Second mismatch?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Skip again', 'next' => 'wrong_b'],
                ['label' => 'Stop', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. abxyc, abc → 3 instead of 2.\nStep back to when you skipped twice.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(|s| + |t|). The guide’s checks → 4, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
