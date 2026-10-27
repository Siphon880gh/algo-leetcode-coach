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
            'message' => "Read the problem statement above.\nReverse the suffix \"502\" of \"1502\". Its inner cost?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Unchanged: the same pairs read backwards', 'next' => 's2'],
                ['label' => 'Recompute it for every split', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Recomputing costs O(n) per split, O(n²) in all, and it is not needed: distance is symmetric.\nStep back to when you recomputed.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which splits do you try?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only none or the whole string', 'next' => 'wrong_b'],
                ['label' => 'Every k, plus no reversal', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 needs k = 1 for 9. Whole-or-nothing gives 12.\nStep back to when you skipped the middle splits.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. One changed edge per split. O(n). Examples give 9, 12 and 6.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
