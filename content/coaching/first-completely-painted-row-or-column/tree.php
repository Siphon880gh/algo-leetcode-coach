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
            'message' => "Read the problem statement above.\nA row is complete at?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'n painted cells, the row length', 'next' => 's2'],
                ['label' => 'm painted cells', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Rows and columns have different lengths; arr = [1,4,2,3,5,6], mat = [[1,2,3],[4,5,6]] → 2 instead of 1.\nStep back to when you swapped the lengths.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Find arr[i]’s cell how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Search the matrix each time', 'next' => 'wrong_b'],
                ['label' => 'A value → cell map built once', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. With m · n = 10^5 that is about 10^10 steps instead of 10^5.\nStep back to when you searched.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m · n). Examples → 2, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
