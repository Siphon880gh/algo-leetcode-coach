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
            'message' => "Read the problem statement above.\nCan you write results into the input as you go?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: read from the original, write to a new grid', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Later cells would average already-smoothed values.\nStep back to when you wrote in place.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How many cells go into a corner's average?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Always 9, counting outside cells as 0', 'next' => 'wrong_b'],
                ['label' => 'Only the in-bounds ones: 4 at a corner, 6 on an edge', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Cells outside the grid are skipped, not treated as 0.\nStep back to when you divided by 9.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How do you round?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Floor: integer division of sum by count', 'next' => 'success'],
                ['label' => 'Round to nearest', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The problem floors the average.\nStep back to when you rounded.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Each cell is smoothed in O(1): O(m · n). [[1,1,1],[1,0,1],[1,1,1]] → all 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
