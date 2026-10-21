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
            'message' => "Read the problem statement above.\nWhat can you take from a pile?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A prefix from the top', 'next' => 's2'],
                ['label' => 'Any coins', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 would give 100 + 9 = 109, but 9 is under 7 and 8.\nStep back to when you ignored the order.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Combine piles?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Greedily take the best top coin each time', 'next' => 'wrong_b'],
                ['label' => 'Grouped knapsack over coin counts', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → 15 (7 then 8) instead of 101.\nStep back to when you chose greedily.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Updating dp for one pile?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Build new from the old dp', 'next' => 'success'],
                ['label' => 'Update dp in place', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. In place, two prefixes of the same pile could both be counted.\nStep back to when you updated in place.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(k · Σ pile sizes). Examples → 101, 706.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
