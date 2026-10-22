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
            'message' => "Read the problem statement above.\nOn a positive number?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Store it and reset k to 0', 'next' => 's2'],
                ['label' => 'Store it and keep k', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. k counts consecutive −1s only; example 2 → [1, 1, −1] instead of [1, 2, 1].\nStep back to when you kept k.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "k-th from?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The oldest', 'next' => 'wrong_b'],
                ['label' => 'The newest', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → [1, 2, −1] instead of [2, 1, −1].\nStep back to when you counted from the oldest.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²) with front inserts, n ≤ 100. Examples → [2, 1, −1], [1, 2, 1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
