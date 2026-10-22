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
            'message' => "Read the problem statement above.\nLength of −15?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '3, the sign counts', 'next' => 's2'],
                ['label' => '2, digits only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The minus sign is part of the text; Example 2 → [2,1,2] instead of [3,1,2].\nStep back to when you dropped the sign.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Per column take?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The length of the largest value', 'next' => 'wrong_b'],
                ['label' => 'The longest length', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A smaller negative can be longer; [[−100],[5]] → [1] instead of [4].\nStep back to when you took the largest value.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m · n · digits). Examples → [3], [3,1,2].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
