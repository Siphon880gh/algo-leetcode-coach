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
            'message' => "Read the problem statement above.\nWhat can the double reversal lose?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Trailing zeros only', 'next' => 's2'],
                ['label' => 'Any repeated digit', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. 526 and 112 come back unchanged; only a trailing 0 disappears.\nStep back to when you blamed other digits.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "num = 0?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'False, it ends in 0', 'next' => 'wrong_b'],
                ['label' => 'True', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 3 → true.\nStep back to when you returned false.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Reverse as strings without converting back to numbers?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, leading zeros must be dropped', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. 1800 → 0081 → 1800 would say true, but Example 2 is false.\nStep back to when you kept leading zeros.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). Examples → true, false, true.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
