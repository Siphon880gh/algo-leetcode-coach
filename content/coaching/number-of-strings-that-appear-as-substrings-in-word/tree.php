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
            'message' => "Read the problem statement above.\nDuplicate patterns?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Count each', 'next' => 's2'],
                ['label' => 'Count once', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Example 3 counts three 'a's.\nStep back to when you deduplicated.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Check type?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Subsequence', 'next' => 'wrong_b'],
                ['label' => 'Substring', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Characters must be contiguous.\nStep back to when you allowed gaps.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Need Aho–Corasick here?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, sizes are tiny', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. At most 100 × 100 characters.\nStep back to when you built an automaton.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Examples → 3, 2, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
