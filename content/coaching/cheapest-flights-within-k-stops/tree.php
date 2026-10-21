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
            'message' => "Read the problem statement above.\nPlain Dijkstra on cost?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: a cheap path with too many stops can block a valid one', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Dijkstra ignores the stop limit when it settles a node.\nStep back to when you used plain Dijkstra.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How many relaxation rounds?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'k', 'next' => 'wrong_b'],
                ['label' => 'k + 1, one per flight', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. k stops allow k + 1 flights.\nStep back to when you ran k rounds.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Relax in place within a round?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: read from the previous round, write to a copy', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. In-place updates chain several flights in one round.\nStep back to when you relaxed in place.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(k · E). n = 4, flights [[0,1,100],[1,2,100],[2,0,100],[1,3,600],[2,3,200]], 0 → 3, k = 1 → 700.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
