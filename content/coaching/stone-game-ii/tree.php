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
            'message' => "Read the problem statement above.\nTrack both players' scores in the state?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: the rest is suffix[i] minus my share', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The total from i on is fixed, so one value is enough.\nStep back to when you tracked both.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "i + 2M ≥ n. Value?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Try each x anyway', 'next' => 'wrong_b'],
                ['label' => 'suffix[i]: take everything', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Taking all remaining piles is best.\nStep back to when you kept branching.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Taking x piles. Next state?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'dp(i + x, max(M, x))', 'next' => 'success'],
                ['label' => 'dp(i + x, x)', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. M never decreases.\nStep back to when you set M to x.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n³). [2,7,9,4,4] → 10. [1,2,3,4,5,100] → 104.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
