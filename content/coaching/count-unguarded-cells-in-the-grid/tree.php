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
            'message' => "Read the problem statement above.\nWalls?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Stop the line of sight', 'next' => 's2'],
                ['label' => 'Ignore them', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 3 instead of 7.\nStep back to when you ignored walls.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Directions?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Right and down only', 'next' => 'wrong_b'],
                ['label' => 'All four', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → 8 instead of 7.\nStep back to when you used two directions.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Cells to count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Unseen cells that are neither guard nor wall', 'next' => 'success'],
                ['label' => 'Every unseen cell', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Guards and walls are not unguarded cells; Example 1 → 13 instead of 7.\nStep back to when you counted every cell.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m · n). Examples → 7, 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
