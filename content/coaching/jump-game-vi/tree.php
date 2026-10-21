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
            'message' => "Read the problem statement above.\nScan k previous values?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: sliding-window maximum', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. O(n · k) is too slow at 10^5 each.\nStep back to when you scanned.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Pop from the front when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'dp is negative', 'next' => 'wrong_b'],
                ['label' => 'Index < i − k', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Only distance makes a candidate invalid.\nStep back to when you popped by value.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Pop from the back when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'dp[back] ≤ dp[i]', 'next' => 'success'],
                ['label' => 'Never', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Dominated values never become the max.\nStep back to when you kept them.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 7, 17, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
