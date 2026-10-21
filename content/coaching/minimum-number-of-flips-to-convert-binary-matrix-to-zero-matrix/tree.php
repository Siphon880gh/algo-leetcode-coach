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
            'message' => "Read the problem statement above.\nState?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A bitmask of the matrix', 'next' => 's2'],
                ['label' => 'The flips made so far', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Different flip orders reach the same matrix.\nStep back to when you stored flips.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A flip affects?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only the cell', 'next' => 'wrong_b'],
                ['label' => 'The cell and its 4 neighbours', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Neighbours flip too.\nStep back to when you flipped one cell.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Mask never reaches 0?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return −1', 'next' => 'success'],
                ['label' => 'Return the BFS depth', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Some matrices are unsolvable.\nStep back to when you returned a depth.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(2^(m·n) · m · n). [[0,0],[0,1]] → 3. [[0]] → 0. [[1,0,0],[1,0,0]] → −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
