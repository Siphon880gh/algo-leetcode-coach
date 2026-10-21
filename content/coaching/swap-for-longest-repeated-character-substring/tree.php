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
            'message' => "Read the problem statement above.\nRun of length L. Best after one swap?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'min(L + 1, count[ch])', 'next' => 's2'],
                ['label' => 'L + 1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A letter must exist elsewhere to swap in.\nStep back to when you added 1 without a cap.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Join two runs across which gaps?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any gap', 'next' => 'wrong_b'],
                ['label' => 'A gap of exactly one letter', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. One swap fills one slot.\nStep back to when you allowed any gap.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Joined length?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'min(L1 + L2 + 1, count[ch])', 'next' => 'success'],
                ['label' => 'L1 + L2 + 1', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. With no third run, the swapped letter comes from one end.\nStep back to when you skipped the cap.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). \"ababa\" → 3. \"aaabaaa\" → 6. \"aaaaa\" → 5.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
