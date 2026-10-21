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
            'message' => "Read the problem statement above.\nWhich removals to test?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'nums[i − 1] and nums[i] at the first drop', 'next' => 's2'],
                ['label' => 'Only nums[i]', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. In [1, 10, 2, 3] you must remove 10.\nStep back to when you tested one.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Already strictly increasing?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'False', 'next' => 'wrong_b'],
                ['label' => 'True', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The statement says return true.\nStep back to when you returned false.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Equal neighbours?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Count as a drop', 'next' => 'success'],
                ['label' => 'Allowed', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Strictly increasing forbids equals.\nStep back to when you allowed them.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → true, false, false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
