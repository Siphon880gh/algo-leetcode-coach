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
            'message' => "Read the problem statement above.\nans[i]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'nums[nums[i]]', 'next' => 's2'],
                ['label' => 'nums[i]', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That just copies the array.\nStep back to when you dropped the double index.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "In place: read the old value how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'nums[x]', 'next' => 'wrong_b'],
                ['label' => 'nums[x] % n', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The cell may already hold a packed value.\nStep back to when you read it raw.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Final in-place step?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Divide each cell by n', 'next' => 'success'],
                ['label' => 'Take each cell mod n', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Mod n returns the old value.\nStep back to when you used mod.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → [0,1,2,4,5,3], [4,5,0,1,2,3].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
