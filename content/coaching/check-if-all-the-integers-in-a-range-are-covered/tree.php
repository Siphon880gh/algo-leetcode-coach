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
            'message' => "Read the problem statement above.\nDecrement position?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'end + 1', 'next' => 's2'],
                ['label' => 'end', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Ranges are inclusive.\nStep back to when you decremented at end.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Covered means?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Running count == 1', 'next' => 'wrong_b'],
                ['label' => 'Running count > 0', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Overlaps still cover.\nStep back to when you required exactly one.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Integers to check?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every x in [left, right]', 'next' => 'success'],
                ['label' => 'Only left and right', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A gap can sit in the middle.\nStep back to when you checked the ends.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + 50). Examples → true, false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
