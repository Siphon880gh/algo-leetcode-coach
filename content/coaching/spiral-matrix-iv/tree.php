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
            'message' => "Read the problem statement above.\nTurn when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The next cell is outside or already written', 'next' => 's2'],
                ['label' => 'Only at the grid edge', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The walk loops back over the first row; Example 1 → first row [0,0,2,6,8].\nStep back to when you turned only at edges.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Unwritten marker?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '0', 'next' => 'wrong_b'],
                ['label' => '−1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. 0 is a real value, and leftover cells must show −1; Example 1 → middle row [5,0,0,0,1].\nStep back to when you used 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "After the list ends?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Stop; the rest stays −1', 'next' => 'success'],
                ['label' => 'Keep filling with 0', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Example 2 → [[0,1,2,0]] instead of [[0,1,2,-1]].\nStep back to when you kept filling.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m · n). Examples → [[3,0,2,6,8],[5,0,-1,-1,1],[5,2,4,9,7]], [[0,1,2,-1]].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
