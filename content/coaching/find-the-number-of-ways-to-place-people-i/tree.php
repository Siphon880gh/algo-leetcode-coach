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
            'message' => "Read the problem statement above.\nEqual x sorted by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'y descending', 'next' => 's2'],
                ['label' => 'y ascending', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. [[1, 3], [1, 1]] → 0 instead of 1.\nStep back to when you sorted y upward.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Count B when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every later point with y_B ≤ y_A', 'next' => 'wrong_b'],
                ['label' => 'y_B ≤ y_A and above every earlier counted y', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A point inside the rectangle blocks it; example 2 → 3 instead of 2.\nStep back to when you counted every point.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). Examples → 0, 2, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
