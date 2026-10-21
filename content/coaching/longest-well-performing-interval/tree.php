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
            'message' => "Read the problem statement above.\nUse a sliding window?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: the score is not monotone in the window', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Shrinking can raise or lower the sum.\nStep back to when you slid a window.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Prefix sum is positive at day i. Best interval ending here?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Look it up in the map', 'next' => 'wrong_b'],
                ['label' => 'The whole prefix, length i + 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Everything so far already qualifies.\nStep back to when you looked it up.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Otherwise, which earlier prefix do you look for?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'prefix − 1', 'next' => 'success'],
                ['label' => 'prefix + 1', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The interval needs a positive sum.\nStep back to when you used prefix + 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [9,9,6,0,6,6,9] → 3. [6,6,6] → 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
