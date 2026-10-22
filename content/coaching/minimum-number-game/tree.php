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
            'message' => "Read the problem statement above.\nPairs from?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The sorted array', 'next' => 's2'],
                ['label' => 'The input order', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Each round removes the two smallest; example 1 → [4, 5, 3, 2] instead of [3, 2, 5, 4].\nStep back to when you kept input order.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Order inside a pair?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Smaller first', 'next' => 'wrong_b'],
                ['label' => 'Larger first', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Bob appends first, and he holds the larger; example 1 → [2, 3, 4, 5].\nStep back to when you put the smaller first.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → [3, 2, 5, 4], [5, 2].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
