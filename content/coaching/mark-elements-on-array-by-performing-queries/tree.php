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
            'message' => "Read the problem statement above.\nAlready marked in the sweep?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Skip without using k', 'next' => 's2'],
                ['label' => 'Count toward k', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → [8, 5, 0] instead of [8, 3, 0].\nStep back to when you counted marked elements.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Unmarked sum?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Re-add the unmarked values per query', 'next' => 'wrong_b'],
                ['label' => 'Subtract each newly marked value', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That is up to n · m = 10^10 additions.\nStep back to when you re-summed.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n + m). Examples → [8, 3, 0], [7].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
