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
            'message' => "Read the problem statement above.\nWhich edges to keep?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Add edges lightest first with union-find', 'next' => 's2'],
                ['label' => 'Delete the k − 1 heaviest edges', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. n = 3, edges [[0, 1, 2], [1, 2, 7], [0, 2, 1]], k = 2 → 2 instead of 1.\nStep back to when you deleted the heaviest.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "When to stop adding?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'After every edge (a full spanning tree)', 'next' => 'wrong_b'],
                ['label' => 'As soon as there are k or fewer components', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. n = 3, edges [[0, 1, 2], [1, 2, 7], [0, 2, 1]], k = 2 → 2 instead of 1.\nStep back to when you kept going.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(E log E). Examples → 4, 5.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
