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
            'message' => "You are wrong. fruits = [2, 9, 3, 5, 5], baskets = [8, 4, 3, 4, 8] → 1 instead of 2.\nStep back to when you used a sorted set.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Descend?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Right child first', 'next' => 'wrong_b'],
                ['label' => 'Left child if it fits', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. fruits = [2, 2, 5, 6], baskets = [4, 3, 6, 2] → 2 instead of 1.\nStep back to when you went right.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 1, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
