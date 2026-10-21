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
            'message' => "Read the problem statement above.\nExpand from each center until hitting a mine?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: precompute arm lengths with four sweeps', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(n³).\nStep back to when you expanded each center.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A sweep hits a mine. Its running count becomes?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Unchanged', 'next' => 'wrong_b'],
                ['label' => '0', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A mine breaks every arm passing through it.\nStep back to when you kept counting.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How do the four counts combine?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Take their minimum: the shortest arm limits the plus', 'next' => 'success'],
                ['label' => 'Take their sum', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A plus needs all four arms of equal length.\nStep back to when you summed.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). n = 5, mines [[4,2]] → 2. n = 1, mines [[0,0]] → 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
