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
            'message' => "Read the problem statement above.\nThe winner of a fight?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Loses 1 health', 'next' => 's2'],
                ['label' => 'Keeps its health', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Each win costs 1; example 2 → [15] instead of [14].\nStep back to when you kept the health.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Report survivors in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Position order', 'next' => 'wrong_b'],
                ['label' => 'Input order', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 lists positions in descending order; → [10, 15, 9, 17, 2] instead of [2, 17, 9, 15, 10].\nStep back to when you sorted the output.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → [2, 17, 9, 15, 10], [14], [].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
