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
            'message' => "Read the problem statement above.\nDiagonal key?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'i − j', 'next' => 's2'],
                ['label' => 'i + j', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. i + j groups anti-diagonals.\nStep back to when you used the sum.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Sort direction for write-back?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Descending', 'next' => 'wrong_b'],
                ['label' => 'Ascending along the diagonal', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Values must increase from top-left.\nStep back to when you sorted descending.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Sort rows too?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: only diagonals', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That would mix diagonals.\nStep back to when you sorted rows.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m · n · log min(m, n)). [[3,3,1,1],[2,2,1,2],[1,1,1,2]] → [[1,1,1,1],[1,2,2,2],[1,2,3,3]].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
