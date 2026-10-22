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
            'message' => "Read the problem statement above.\nInclude the cell itself?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, only strictly up-left and down-right', 'next' => 's2'],
                ['label' => 'Yes, on both sides', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. A repeated value then counts differently; example 1 → [[0,1,0],[1,0,1],[0,1,0]] instead of [[1,1,0],[1,0,1],[0,1,1]].\nStep back to when you included the cell.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Count what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every value', 'next' => 'wrong_b'],
                ['label' => 'Distinct values', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Repeats must count once; example 1 → [[2,1,0],[1,0,1],[0,1,2]] instead of [[1,1,0],[1,0,1],[0,1,1]].\nStep back to when you counted repeats.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m · n · min(m, n)). Examples → [[1,1,0],[1,0,1],[0,1,1]], [[0]].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
