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
            'message' => "Read the problem statement above.\nUpdate every element on addAll?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: lazy global map', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(n) per call.\nStep back to when you updated all.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "multAll(k)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'm ·= k only', 'next' => 'wrong_b'],
                ['label' => 'm ·= k and a ·= k', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Earlier additions are multiplied too.\nStep back to when you left a.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "append(val)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Store (val − a) · inverse(m)', 'next' => 'success'],
                ['label' => 'Store val', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The global map would wrongly apply past operations.\nStep back to when you stored raw val.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log p) append, O(1) others. The example → 10, 26, 34, 20.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
