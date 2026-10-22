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
            'message' => "Read the problem statement above.\nHow to test membership?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Walk Object.getPrototypeOf', 'next' => 's2'],
                ['label' => 'Use instanceof', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. instanceof is false for primitives; checkIfInstanceOf(5, Number) → false instead of true.\nStep back to when you used instanceof.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Value is null or undefined?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Walk the chain anyway', 'next' => 'wrong_b'],
                ['label' => 'Return false first', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Object.getPrototypeOf(null) throws a TypeError instead of returning false.\nStep back to when you skipped the guard.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(chain length). Examples → true, true, false, true.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
