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
            'message' => "Read the problem statement above.\nok(c): after robbing house i?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Skip house i + 1', 'next' => 's2'],
                ['label' => 'Count every house worth at most c', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Adjacent houses cannot both be robbed; Example 1 → 3 instead of 5.\nStep back to when you counted neighbours.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "ok(c) is true. Next?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Try a larger c', 'next' => 'wrong_b'],
                ['label' => 'Try a smaller c', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. You want the minimum capability; Example 1 → 9 instead of 5.\nStep back to when you moved up.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log max). Examples → 5, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
