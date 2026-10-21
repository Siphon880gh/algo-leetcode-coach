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
            'message' => "Read the problem statement above.\nGreedy largest-first to the least loaded worker?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, it is not optimal', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Greedy assignment can miss a perfect split like 11 / 11.\nStep back to when you trusted greedy.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Transition?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Try every mask pair', 'next' => 'wrong_b'],
                ['label' => 'Enumerate submasks of the mask', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Submask enumeration gives O(3^n) total, which is fine for n ≤ 12.\nStep back to when you paired all masks.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Combine?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'max(previous workers, this subset sum)', 'next' => 'success'],
                ['label' => 'Sum of both', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The objective is the largest single load.\nStep back to when you added them.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(k · 3^n). Examples → 3, 11.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
