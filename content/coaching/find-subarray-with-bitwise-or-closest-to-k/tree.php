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
            'message' => "Read the problem statement above.\nCandidates?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'ORs of every subarray ending at i', 'next' => 's2'],
                ['label' => 'Single elements', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 1 instead of 0 (1 OR 2 = 3).\nStep back to when you used single elements.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Track them how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every subarray directly', 'next' => 'wrong_b'],
                ['label' => 'Carry the set of at most about 30 values', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That is about 5 · 10^9 subarrays at n = 10^5.\nStep back to when you listed every subarray.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(30 n). Examples → 0, 1, 9.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
