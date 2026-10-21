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
            'message' => "Read the problem statement above.\nCondition 3 cost?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'm + n − max over letters of (ca + cb)', 'next' => 's2'],
                ['label' => 'Fix a and b separately', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Both strings must use the same single letter.\nStep back to when you fixed them separately.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Split range?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Include z', 'next' => 'wrong_b'],
                ['label' => 'After a … after y (25 splits)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Nothing is strictly greater than z.\nStep back to when you included z.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "a < b cost at split i?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'a letters above i + b letters at or below i', 'next' => 'success'],
                ['label' => 'Only a letters above i', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. b must also move above the split.\nStep back to when you ignored b.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m + n + 26). Examples → 2, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
