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
            'message' => "Read the problem statement above.\nn reaches 10^5. Approach?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Monotonic stacks for both sides', 'next' => 's2'],
                ['label' => 'Try every peak', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That is about 10^10 steps.\nStep back to when you tried every peak.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "left[i] = ?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'left[i − 1] + h[i]', 'next' => 'wrong_b'],
                ['label' => 'left[p] + h[i]·(i − p), p = previous smaller', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Earlier towers must shrink to h[i]; the examples → 14, 32, 20 instead of 13, 22, 18.\nStep back to when you added h[i].",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 13, 22, 18. Use 64-bit sums.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
