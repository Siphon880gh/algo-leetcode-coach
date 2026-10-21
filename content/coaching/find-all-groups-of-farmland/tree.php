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
            'message' => "Read the problem statement above.\nWhere does a group start?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Farmland with no farmland above or to the left', 'next' => 's2'],
                ['label' => 'At every farmland cell', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Each group would be reported once per cell.\nStep back to when you started everywhere.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Bottom-right corner?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Walk diagonally until forest', 'next' => 'wrong_b'],
                ['label' => 'Walk down the column and right along the row', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A 1 × 3 group stops the diagonal at its first cell.\nStep back to when you walked diagonally.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Output order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any order', 'next' => 'success'],
                ['label' => 'Sorted by area', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Any order is accepted.\nStep back to when you sorted by area.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(mn). Examples → [[0,0,0,0],[1,1,2,2]], [[0,0,1,1]], [].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
