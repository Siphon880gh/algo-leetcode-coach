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
            'message' => "Read the problem statement above.\nHow to define last?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A regular function', 'next' => 's2'],
                ['label' => 'An arrow function', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. An arrow function does not bind this to the array; in Node Example 1 → −1 instead of 3.\nStep back to when you used an arrow.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How to detect an empty array?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The last element is falsy', 'next' => 'wrong_b'],
                ['label' => 'this.length === 0', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A last element of 0 is falsy too; [0].last() → −1 instead of 0.\nStep back to when you tested the element.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). Examples → 3, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
