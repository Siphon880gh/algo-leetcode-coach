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
            'message' => "Read the problem statement above.\nWhich prime to subtract?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The largest that keeps x − p > prev', 'next' => 's2'],
                ['label' => 'The smallest prime', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Values must shrink as much as possible; Example 1 → false instead of true.\nStep back to when you took the smallest prime.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "No prime fits, but x > prev?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return false', 'next' => 'wrong_b'],
                ['label' => 'Keep x', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Subtracting is optional; nums = [1,2] → false instead of true.\nStep back to when you gave up.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · π(1000)). Examples → true, true, false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
