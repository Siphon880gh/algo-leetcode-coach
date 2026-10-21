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
            'message' => "Read the problem statement above.\nSolve whenever possible?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: compare solve and skip at each question', 'next' => 's2'],
                ['label' => 'Yes, take each question you are allowed to', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2: solving 0 and 2 gives 4, but the answer is 7 (questions 1 and 4).\nStep back to when you solved greedily.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Skip question i?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Skipping also blocks the next brainpower[i]', 'next' => 'wrong_b'],
                ['label' => 'f(i) can be f(i + 1)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Only solving costs the next brainpower[i] questions; skipping blocks nothing.\nStep back to when you blocked after a skip.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Totals?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '64-bit', 'next' => 'success'],
                ['label' => '32-bit', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Up to 10^5 questions of up to 10^5 points can reach 10^10.\nStep back to when you chose 32-bit.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 5, 7.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
