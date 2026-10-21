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
            'message' => "Read the problem statement above.\nApex height recurrence?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1 + min of the three cells below', 'next' => 's2'],
                ['label' => '1 + min of the two diagonal cells below', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The cell straight below must be fertile too; [[1,1,1],[1,0,1]] has no pyramid, but the diagonals alone give one.\nStep back to when you skipped the middle cell.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Pyramids with apex (i, j)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'height', 'next' => 'wrong_b'],
                ['label' => 'height − 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A single cell is not a pyramid; height 1 adds nothing.\nStep back to when you counted height.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Inverse pyramids?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The same DP on the grid with rows reversed', 'next' => 'success'],
                ['label' => 'Not needed', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Example 2 → 2 counts one pyramid and one inverse pyramid.\nStep back to when you skipped them.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m · n). Examples → 2, 2, 13.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
