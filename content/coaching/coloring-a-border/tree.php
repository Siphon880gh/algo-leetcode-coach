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
            'message' => "Read the problem statement above.\nPaint cells while you search?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: collect border cells first', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Painted cells confuse later neighbour checks.\nStep back to when you painted during the search.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "When is a component cell on the border?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only on the grid edge', 'next' => 'wrong_b'],
                ['label' => 'On the grid edge or next to a different color', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Cells next to other colors are border too.\nStep back to when you only checked the edge.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Interior cells of the component. Paint them?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Only the border changes color.\nStep back to when you painted the interior.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m · n). [[1,1],[1,2]], (0,0), color 3 → [[3,3],[3,2]]. [[1,2,2],[2,3,2]], (0,1), color 3 → [[1,3,3],[2,3,3]]. [[1,1,1],[1,1,1],[1,1,1]], (1,1), color 2 → [[2,2,2],[2,1,2],[2,2,2]].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
