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
            'message' => "Problem: You are given a list of equations, each a pair of variable names [A, B], and a list of values, where equations[i] with values[i] states that A / B = values[i]. Return true if the equations contradict each other and false otherwise. Two computed ratios count as equal when they differ by less than a small tolerance that the statement gives. For instance, a / b = 3, b / c = 0.5, a / c = 1.5 → false; le / et = 2, le / code = 5, code / et = 0.5 → true. (Restated from memory; limits and examples may differ slightly.)\nCompare two ratios how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Within the tolerance', 'next' => 's2'],
                ['label' => 'Exact equality', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. a / b = 0.1, b / c = 0.2, a / c = 0.02: 0.1 · 0.2 is 0.020000000000000004 in floating point → true instead of false.\nStep back to when you compared exactly.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Weight of the old root on merge?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'v', 'next' => 'wrong_b'],
                ['label' => 'v · w[B] / w[A]', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That ignores where A and B sit; d / b = 4, a / b = 4, a / e = 4/3, d / e = 4/3, d / a = 1 → true instead of false.\nStep back to when you used v.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Path compression?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Multiply weights along the path', 'next' => 'success'],
                ['label' => 'Just point the node at the root', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The ratio to the old parent is lost; c / b = 1.5, b / e = 2, c / a = 3, e / d = 0.5, b / a = 2 → true instead of false.\nStep back to when you skipped the multiplication.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n α(n)). Constructed cases → false, true.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
