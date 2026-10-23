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
            'message' => "Read the problem statement above.\nWhich basket?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The leftmost that fits', 'next' => 's2'],
                ['label' => 'The smallest that fits', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. fruits = [2, 9, 3, 5, 5], baskets = [8, 4, 3, 4, 8] → 1 instead of 2.\nStep back to when you used best fit.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Used basket?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Can take another fruit', 'next' => 'wrong_b'],
                ['label' => 'Never reused', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → 0 instead of 1.\nStep back to when you reused it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). Examples → 1, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
