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
            'message' => "Read the problem statement above.\nFill order for isPal?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'i descending, j ascending', 'next' => 's2'],
                ['label' => 'i ascending', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. isPal[i][j] needs isPal[i + 1][j − 1] first.\nStep back to when you went i ascending.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Cut ranges?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '0 ≤ i ≤ j ≤ n − 1', 'next' => 'wrong_b'],
                ['label' => '0 ≤ i < j < n − 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. All three pieces must be non-empty.\nStep back to when you allowed empty pieces.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Faster than n² pairs?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Not needed for n ≤ 2000', 'next' => 'success'],
                ['label' => 'Must use Manacher', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. 4 · 10^6 checks are cheap.\nStep back to when you reached for Manacher.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). Examples → true, false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
