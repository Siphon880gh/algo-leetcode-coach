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
            'message' => "Read the problem statement above.\nFewest steps?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'max(|dx|, |dy|)', 'next' => 's2'],
                ['label' => '|dx| + |dy|', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Diagonals cover both at once; example 1 → false instead of true.\nStep back to when you used Manhattan distance.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Start on the target with t = 1?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'true', 'next' => 'wrong_b'],
                ['label' => 'false', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. You must move and cannot return in one step; in code that case → true instead of false.\nStep back to when you allowed it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). Examples → true, false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
