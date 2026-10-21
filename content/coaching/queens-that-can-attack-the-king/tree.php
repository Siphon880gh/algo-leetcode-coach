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
            'message' => "Read the problem statement above.\nCheck each queen against the king only?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: a nearer queen blocks', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Queens behind another queen cannot attack.\nStep back to when you ignored blocking.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Directions?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only the 4 straight ones', 'next' => 'wrong_b'],
                ['label' => 'All 8, including diagonals', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Queens attack diagonally too.\nStep back to when you used four.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Found a queen on a ray. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Stop that ray', 'next' => 'success'],
                ['label' => 'Keep walking', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Further queens are blocked.\nStep back to when you kept walking.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(64). King [0,0] → [[0,1],[1,0],[3,3]]. King [3,3] → [[2,2],[3,4],[4,4]].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
