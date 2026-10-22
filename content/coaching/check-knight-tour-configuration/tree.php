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
            'message' => "Read the problem statement above.\nCheck grid[0][0] = 0?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes, first', 'next' => 's2'],
                ['label' => 'No, moves are enough', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. A legal tour can start elsewhere; Example 1 renumbered as 24 − value → true instead of false.\nStep back to when you skipped the start.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A legal step between moves k and k + 1?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Both differences at most 2', 'next' => 'wrong_b'],
                ['label' => 'Differences 1 and 2 in some order', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That allows king-like steps; Example 2 → true instead of false.\nStep back to when you loosened the check.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). Examples → true, false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
