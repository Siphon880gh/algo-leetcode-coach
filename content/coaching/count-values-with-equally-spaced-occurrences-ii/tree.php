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
            'message' => "Read the problem statement above.\nHow many copies does a special value need in part II?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Exactly three', 'next' => 'wrong_a'],
                ['label' => 'At least three', 'next' => 's2'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Part II allows three or more. Requiring exactly three gives 0 instead of 1 for Example 2.\nStep back to when you required exactly three.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "nums = [7, 7, 7, 1, 7]\nvalue 7 at 0, 1, 2, 4\nSpecial?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes, the first three are evenly spaced', 'next' => 'wrong_b'],
                ['label' => 'No, the gaps are 1, 1 and 2', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The last gap is 2, not 1. Checking only three copies gives 1 instead of 0.\nStep back to when you stopped after three.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Group, then compare every gap with the first. O(n). Examples give 2, 1 and 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
