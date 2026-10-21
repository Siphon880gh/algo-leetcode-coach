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
            'message' => "Read the problem statement above.\nHeight on a 0 cell?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Reset to 0', 'next' => 's2'],
                ['label' => 'Keep the previous height', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A 0 breaks every column of ones.\nStep back to when you kept it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Walking left, add?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Current height only', 'next' => 'wrong_b'],
                ['label' => 'Running min of heights', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Wider rectangles are limited by the shortest column.\nStep back to when you added h[j] only.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Stop walking left when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Min height hits 0', 'next' => 'success'],
                ['label' => 'Never', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Nothing further left can contribute.\nStep back to when you kept walking.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(R · C²). Example 1 → 13. Example 2 → 24.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
