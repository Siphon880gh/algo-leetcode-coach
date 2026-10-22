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
            'message' => "Read the problem statement above.\nPer query?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Delete skipped cities', 'next' => 's2'],
                ['label' => 'BFS', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That is about 10^10 steps.\nStep back to when you ran BFS.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Delete which cities?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Up to and including v', 'next' => 'wrong_b'],
                ['label' => 'Strictly between u and v', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1’s first answer → 2 instead of 3.\nStep back to when you deleted v.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + q). Examples → [3, 2, 1], [1, 1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
