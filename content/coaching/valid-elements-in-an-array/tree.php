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
            'message' => "Read the problem statement above.\nComparison?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Strictly greater', 'next' => 's2'],
                ['label' => 'Greater or equal', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → [5, 5, 5, 5] instead of [5, 5].\nStep back to when you allowed ties.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Passes?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Left only, plus the last element', 'next' => 'wrong_b'],
                ['label' => 'Left and right', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → [1, 2, 4, 2] instead of [1, 2, 4, 3, 2].\nStep back to when you skipped the right pass.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → [1, 2, 4, 3, 2], [5, 5], [1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
