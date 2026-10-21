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
            'message' => "Read the problem statement above.\nNeed negative-value handling?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: all values ≥ 1', 'next' => 's2'],
                ['label' => 'Yes, check the two smallest', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. With values ≥ 1, (x − 1) ≥ 0.\nStep back to when you checked the smallest.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Duplicate maximum?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Take the next distinct value', 'next' => 'wrong_b'],
                ['label' => 'Use it twice (different indices)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [1,5,4,5] → 16.\nStep back to when you skipped the duplicate.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Sort required?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: O(n) scan', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Two variables suffice.\nStep back to when you sorted.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [3,4,5,2] → 12. [1,5,4,5] → 16. [3,7] → 12.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
