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
            'message' => "Read the problem statement above.\nReachable means?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Same component (chains allowed)', 'next' => 's2'],
                ['label' => 'A direct edge', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → [false, false, false, true] instead of [false, false, true, true].\nStep back to when you required a direct edge.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "New component when the gap is?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '≥ maxDiff', 'next' => 'wrong_b'],
                ['label' => '> maxDiff', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. nums = [1, 2], maxDiff = 1, query [0, 1] → false instead of true.\nStep back to when you split on an equal gap.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + q). Examples → [true, false], [false, false, true, true].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
