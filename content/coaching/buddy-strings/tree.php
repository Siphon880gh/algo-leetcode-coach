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
            'message' => "Read the problem statement above.\ns == goal. When is the answer true?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only if some letter repeats', 'next' => 's2'],
                ['label' => 'Always', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The swap is required; with all letters distinct, any swap changes the string.\nStep back to when you returned true.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "s != goal (same length). What do you need?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At most two mismatched positions', 'next' => 'wrong_b'],
                ['label' => 'Exactly two mismatched positions i and j', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A single mismatch cannot be fixed by one swap.\nStep back to when you allowed one.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "There are exactly two mismatches. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Check s[i] == goal[j] and s[j] == goal[i]', 'next' => 'success'],
                ['label' => 'Return true', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The swapped letters must cross-match.\nStep back to when you skipped the cross check.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Different lengths → false. \"ab\", \"ba\" → true. \"ab\", \"ab\" → false. \"aa\", \"aa\" → true.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
