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
            'message' => "Read the problem statement above.\nWhich rows connect?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Consecutive non-empty rows', 'next' => 's2'],
                ['label' => 'Every pair of non-empty rows', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A beam needs every row between to be empty; Example 1 would give 11 instead of 8.\nStep back to when you paired all rows.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "An empty row?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Reset the previous count to 0', 'next' => 'wrong_b'],
                ['label' => 'Skip it and keep the previous count', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Empty rows let beams pass; resetting gives 2 for Example 1 instead of 8.\nStep back to when you reset.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Devices in the same row?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No beam between them', 'next' => 'success'],
                ['label' => 'One beam per pair', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Beams need two different rows; Example 2 → 0.\nStep back to when you paired a row with itself.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m · n). Examples → 8, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
