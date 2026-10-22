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
            'message' => "Read the problem statement above.\nAlice wins when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 's1 ≠ s2', 'next' => 's2'],
                ['label' => 's1 > s2', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. She can take either group: example 3 → false instead of true.\nStep back to when you required s1 > s2.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Single-digit means?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'x ≤ 10', 'next' => 'wrong_b'],
                ['label' => 'x < 10', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → true instead of false.\nStep back to when you included 10.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → false, true, true.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
