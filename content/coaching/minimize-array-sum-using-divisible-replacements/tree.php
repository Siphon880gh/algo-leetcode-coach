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
            'message' => "Read the problem statement above.\nReplace with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Smallest divisor in the array', 'next' => 's2'],
                ['label' => 'The overall minimum', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 6 instead of 7; 3 is not divisible by 2.\nStep back to when you ignored divisibility.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which divisor?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The largest one below the value', 'next' => 'wrong_b'],
                ['label' => 'The smallest one', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → 8 instead of 7.\nStep back to when you took the largest divisor.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(M log M). Examples → 7, 9, 21.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
