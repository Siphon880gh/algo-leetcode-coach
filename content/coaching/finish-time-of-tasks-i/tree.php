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
            'message' => "Read the problem statement above.\nCombine children by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Latest and earliest', 'next' => 's2'],
                ['label' => 'Sum of their finish times', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → 17 instead of 12.\nStep back to when you added the children.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "ownDuration?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'baseTime only', 'next' => 'wrong_b'],
                ['label' => '(latest − earliest) + baseTime', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → 11 instead of 12.\nStep back to when you dropped the spread.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 17, 12, 18.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
