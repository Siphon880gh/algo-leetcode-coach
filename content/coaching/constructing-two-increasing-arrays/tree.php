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
            'message' => "Problem: Two arrays hold only 0s and 1s. Replace every 0 with an even positive integer and every 1 with an odd one so that both arrays are increasing and no integer is used twice. Return the smallest possible largest integer. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nFill the arrays?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Together, one counter', 'next' => 's2'],
                ['label' => 'Each on its own', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. [1] and [1] → 1 instead of 3.\nStep back to when you filled them separately.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Combine the two moves?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'max', 'next' => 'wrong_b'],
                ['label' => 'min', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [0, 1, 0, 1] and [1, 0, 0, 1] → 13 instead of 9.\nStep back to when you took max.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n m). The guide’s checks → 5, 9, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
