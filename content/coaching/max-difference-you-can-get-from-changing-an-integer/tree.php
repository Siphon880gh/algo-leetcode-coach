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
            'message' => "Read the problem statement above.\nMinimum when the leading digit is 5?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Replace every 5 with 1', 'next' => 's2'],
                ['label' => 'Replace with 0', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. No leading zeros.\nStep back to when you used 0.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Leading digit already 1?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Replace a later 1 with 0', 'next' => 'wrong_b'],
                ['label' => 'First later digit not 0 or 1 → 0', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Replacing 1 also hits the leading digit.\nStep back to when you replaced a 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Max for 999?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '999 (no change)', 'next' => 'success'],
                ['label' => 'Force a change', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Choosing x = y is allowed.\nStep back to when you forced a change.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(digits). 555 → 888. 9 → 8. 123456 → 820000.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
