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
            'message' => "Read the problem statement above.\nWhat do you check first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'total % k == 0 and max(nums) ≤ total / k', 'next' => 's2'],
                ['label' => 'Nothing; let backtracking discover it', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. These checks rule out many inputs instantly.\nStep back to when you skipped the checks.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Why sort descending?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'It does not matter', 'next' => 'wrong_b'],
                ['label' => 'Big numbers have few places to go, so failures show up early', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Placing small numbers first lets the search wander longer before failing.\nStep back to when you ignored the order.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "A number fails in an empty bucket. Try the next empty bucket?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: every empty bucket is the same, so backtrack', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Empty buckets are interchangeable; the next one fails the same way.\nStep back to when you tried another empty bucket.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Pruned backtracking, or an O(n · 2ⁿ) bitmask DP. [4,3,2,3,5,2,1], k = 4 → true. [1,2,3,4], k = 3 → false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
