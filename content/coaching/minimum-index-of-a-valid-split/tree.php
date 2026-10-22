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
            'message' => "Read the problem statement above.\nReturn which split?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The first valid one', 'next' => 's2'],
                ['label' => 'The last valid one', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The minimum index is asked; example 2 → 8 instead of 4.\nStep back to when you kept the last.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "The right half needs?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '2 · count ≥ its length', 'next' => 'wrong_b'],
                ['label' => '2 · count > its length', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Dominant means more than half; example 3 → 0 instead of −1.\nStep back to when you allowed a tie.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 2, 4, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
