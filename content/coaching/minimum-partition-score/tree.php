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
            'message' => "Read the problem statement above.\nChoose cuts how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'DP over cut positions', 'next' => 's2'],
                ['label' => 'Close a part once its sum reaches total / k', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Constructed check (run in code): nums = [4, 6, 1, 3], k = 3 → 62 instead of 41.\nStep back to when you cut greedily.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Answer from the minimum Σ s²?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Σ s² itself', 'next' => 'wrong_b'],
                ['label' => '(Σ s² + total) / 2', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → 100 instead of 55.\nStep back to when you skipped the conversion.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(k · n). Examples → 25, 55, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
