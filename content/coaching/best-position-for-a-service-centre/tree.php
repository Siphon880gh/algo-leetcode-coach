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
            'message' => "Read the problem statement above.\nAnswer = distance sum at the centroid?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: centroid minimises squared distances', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The geometric median differs from the mean.\nStep back to when you stopped at the centroid.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Why does local search work?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Lucky starting point', 'next' => 'wrong_b'],
                ['label' => 'The objective is convex', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Convexity means no false local minima.\nStep back to when you doubted it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Stop when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Step below about 1e-7', 'next' => 'success'],
                ['label' => 'After one pass', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Precision needs a tiny step.\nStep back to when you stopped early.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. [[0,1],[1,0],[1,2],[2,1]] → 4.0. [[1,1],[3,3]] → 2.82843.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
