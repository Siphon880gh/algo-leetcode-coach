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
            'message' => "Problem: Given a linked list and integers m and n, repeatedly keep m nodes then remove the next n until the end; return the head. For instance, 1→…→10 with m = 2, n = 3 → 1→2→6→7. (Restated from memory; limits and examples may differ slightly.)\nSteps to the last kept node?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'm − 1 from the run start', 'next' => 's2'],
                ['label' => 'm', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That keeps one extra node.\nStep back to when you stepped m times.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Fewer than n nodes left to delete?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Error out', 'next' => 'wrong_b'],
                ['label' => 'Splice to null', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Delete what remains.\nStep back to when you errored.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Extra space?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'None: in-place splicing', 'next' => 'success'],
                ['label' => 'Copy into an array', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Pointer changes suffice.\nStep back to when you copied.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(length). 1→…→10, m = 2, n = 3 → 1→2→6→7.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
