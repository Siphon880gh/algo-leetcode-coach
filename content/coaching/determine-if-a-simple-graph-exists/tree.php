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
            'message' => "Problem: Each vertex has a desired degree. Decide whether some simple undirected graph (no self-loops and no repeated edges) has exactly these degrees. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nWhich test?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Even sum and every Erdős–Gallai prefix', 'next' => 's2'],
                ['label' => 'Even sum only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. [3, 3, 1, 1] → true instead of false.\nStep back to when you checked only parity.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Sort the degrees?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Ascending', 'next' => 'wrong_b'],
                ['label' => 'Descending', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [2, 0, 0] → true instead of false.\nStep back to when you sorted up.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Checks → true, true, false, false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
