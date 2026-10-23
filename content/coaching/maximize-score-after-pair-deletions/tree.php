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
            'message' => "Problem: While the array has more than two elements, remove either the first two, the last two, or the first and last element, and add their sum to the score. Return the largest total score. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nEven length remainder?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Two neighbors', 'next' => 's2'],
                ['label' => 'Any two values', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. [1, 9, 9, 1] → 18 instead of 10.\nStep back to when you left non-neighbors.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Odd length remainder?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only the middle one', 'next' => 'wrong_b'],
                ['label' => 'Any single element', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [4, −1, 2, 6, 0] → 9 instead of 12.\nStep back to when you kept the middle.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Checks → 8, 10, 12.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
