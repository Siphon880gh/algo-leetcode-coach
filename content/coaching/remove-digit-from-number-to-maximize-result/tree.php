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
            'message' => "Read the problem statement above.\nWhich copy, by default?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'First copy whose next digit is larger', 'next' => 's2'],
                ['label' => 'Always the last copy', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 1231 → 123 instead of 231.\nStep back to when you took the last copy.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "No copy has a larger next digit?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Remove the first copy', 'next' => 'wrong_b'],
                ['label' => 'Remove the last copy', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. 3133 with digit 3 → 133 instead of 313.\nStep back to when you fell back to the first copy.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Shortcut: always the first copy?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: check the next digit', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. 3134 with digit 3 → 134 instead of 314.\nStep back to when you took the first copy.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 12, 231, 51.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
