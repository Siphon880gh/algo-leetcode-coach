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
            'message' => "Read the problem statement above.\nWalk the counts from?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '−50 upward', 'next' => 's2'],
                ['label' => '−1 downward', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That finds the x-th largest negative; Example 1 → [−3,−2,−3] instead of [−1,−2,−2].\nStep back to when you walked down.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Fewer than x negatives?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Skip the window', 'next' => 'wrong_b'],
                ['label' => 'Output 0', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Every window needs a value; Example 3 → 4 values instead of 5.\nStep back to when you skipped it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(50 · n). Examples → [−1,−2,−2], [−1,−2,−3,−4], [−3,0,−3,−3,−3].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
