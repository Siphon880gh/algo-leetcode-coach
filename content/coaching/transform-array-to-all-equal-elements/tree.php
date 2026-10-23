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
            'message' => "Read the problem statement above.\nTargets to try?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Both 1 and −1', 'next' => 's2'],
                ['label' => 'Only nums[0]', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. [−1, −1, 1], k = 1 → false instead of true.\nStep back to when you fixed the target.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "After the sweep?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Done, the count is the answer', 'next' => 'wrong_b'],
                ['label' => 'Check that the last element equals the target', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [1, −1, 1], k = 1 → true instead of false.\nStep back to when you skipped the check.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → true, false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
