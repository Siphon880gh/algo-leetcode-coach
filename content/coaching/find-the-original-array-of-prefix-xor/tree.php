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
            'message' => "Read the problem statement above.\narr[i] for i ≥ 1?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'pref[i] XOR pref[i − 1]', 'next' => 's2'],
                ['label' => 'pref[i] − pref[i − 1]', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. These are XOR prefixes, not sums; Example 1 → [5,−3,−2,3,−2] instead of [5,7,2,3,2].\nStep back to when you subtracted.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "arr[0]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '0', 'next' => 'wrong_b'],
                ['label' => 'pref[0]', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. pref[0] is just arr[0]; Example 2 → [0] instead of [13].\nStep back to when you set it to 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → [5,7,2,3,2], [13].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
