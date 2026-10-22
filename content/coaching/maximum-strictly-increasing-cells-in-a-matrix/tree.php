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
            'message' => "Read the problem statement above.\nWhich cells can a cell reach?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any larger cell in its row or column', 'next' => 's2'],
                ['label' => 'Only its four neighbours', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Moves may jump along the line; example 3 → 3 instead of 4.\nStep back to when you used neighbours only.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Cells with equal values?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Update each cell as you go', 'next' => 'wrong_b'],
                ['label' => 'Compute the whole group, then update rows and columns', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Equal values then extend each other; [[1,1],[1,1]] → 3 instead of 1.\nStep back to when you updated inside the group.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(mn log(mn)). Examples → 2, 1, 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
