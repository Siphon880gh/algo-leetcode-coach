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
            'message' => "Read the problem statement above.\nDecide on the dry day itself?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: defer until a flood threatens', 'next' => 's2'],
                ['label' => 'Yes, dry any full lake', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. You may dry the wrong lake.\nStep back to when you decided early.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which dry day?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any earlier dry day', 'next' => 'wrong_b'],
                ['label' => 'Earliest after the last fill', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Drying before it filled does nothing.\nStep back to when you used an earlier day.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Unused dry days?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any lake, e.g. 1', 'next' => 'success'],
                ['label' => '−1', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. −1 is only for rain days.\nStep back to when you wrote −1.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). [1,2,0,0,2,1] → [-1,-1,2,1,-1,-1]. [1,2,0,1,2] → [].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
