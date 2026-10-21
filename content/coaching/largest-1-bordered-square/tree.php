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
            'message' => "Read the problem statement above.\nCheck every square cell by cell?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: precompute left and up runs', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Each border check would cost O(k).\nStep back to when you checked cell by cell.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Cell (i, j) as bottom-right. Largest size to try?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'min(rows, cols)', 'next' => 'wrong_b'],
                ['label' => 'min(left[i][j], up[i][j])', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The bottom and right edges cap the size.\nStep back to when you used the grid size.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Size k. What else must hold?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'left[i − k + 1][j] ≥ k and up[i][j − k + 1] ≥ k', 'next' => 'success'],
                ['label' => 'Nothing else', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The top and left edges must be all 1s too.\nStep back to when you skipped them.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(rows · cols · min(rows, cols)). [[1,1,1],[1,0,1],[1,1,1]] → 9. [[1,1,0,0]] → 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
