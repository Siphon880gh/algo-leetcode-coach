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
            'message' => "Read the problem statement above.\nPrefix and suffix are the same string a?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'cnt[a] · (cnt[a] − 1)', 'next' => 's2'],
                ['label' => 'cnt[a]²', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. An index cannot pair with itself; [1,1,1], target 11 → 6, not 9.\nStep back to when you squared.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Are (i, j) and (j, i) different?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, count once', 'next' => 'wrong_b'],
                ['label' => 'Yes, both count', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 counts (0, 1) and (1, 0) separately to reach 4.\nStep back to when you halved.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "n ≤ 100. Is the double loop too slow?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, it passes', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. 10^4 pairs of short strings are cheap; splitting is just neater.\nStep back to when you ruled it out.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Examples → 4, 2, 6.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
