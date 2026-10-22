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
            'message' => "Read the problem statement above.\nNext after taking [l, r]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'First start > r', 'next' => 's2'],
                ['label' => 'First start ≥ r', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. [[1, 2, 5], [2, 3, 5]] → [0, 1] instead of [0] (shared points overlap).\nStep back to when you allowed ≥.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Return?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Indices in position order', 'next' => 'wrong_b'],
                ['label' => 'Indices sorted', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → [6, 1, 3, 5] instead of [1, 3, 5, 6].\nStep back to when you kept position order.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → [2, 3], [1, 3, 5, 6].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
