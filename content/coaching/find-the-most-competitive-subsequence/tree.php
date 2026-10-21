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
            'message' => "Read the problem statement above.\nPop condition?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'top > x and len(stack) + remaining > k', 'next' => 's2'],
                ['label' => 'top > x only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. You may not be able to refill to k.\nStep back to when you ignored the count.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Push condition?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Always', 'next' => 'wrong_b'],
                ['label' => 'len(stack) < k', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The answer has exactly k elements.\nStep back to when you always pushed.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Equal top?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep it', 'next' => 'success'],
                ['label' => 'Pop it', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Equal values never make it smaller.\nStep back to when you popped.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [3,5,2,6], 2 → [2,6]. Example 2 → [2,3,3,4].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
