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
            'message' => "Read the problem statement above.\nOn a 1, new e1?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'e1 + e0 + 1, replacing the old e1', 'next' => 's2'],
                ['label' => 'Old e1 plus (e1 + e0 + 1)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Every old subsequence ending in 1 reappears as some old one plus this 1, so adding counts duplicates.\nStep back to when you added to e1.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "On a 0, new e0?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'e1 + e0 + 1', 'next' => 'wrong_b'],
                ['label' => 'e1 + e0', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The +1 would start a subsequence with 0, which has a leading zero.\nStep back to when you added 1 on a 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "The subsequence 0 itself?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Add 1 at the end if any 0 exists', 'next' => 'success'],
                ['label' => 'Never count it', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. 0 alone is good; 001 → 2 counts 0 and 1.\nStep back to when you dropped it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 2, 2, 5.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
