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
            'message' => "Read the problem statement above.\nPut-back candidates?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'nums[0 … k − 2]', 'next' => 's2'],
                ['label' => 'nums[0 … k − 1]', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Putting back uses the last move, so nums[k − 1] never ends on top; [1,9,2] with k = 2 → 2, not 9.\nStep back to when you included nums[k − 1].",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "One element, odd k?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return nums[0]', 'next' => 'wrong_b'],
                ['label' => 'Return −1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → −1; the pile ends empty.\nStep back to when you returned the element.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Use nums[k]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only when k < n', 'next' => 'success'],
                ['label' => 'Always', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. With k ≥ n there is no element at index k.\nStep back to when you read past the end.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(min(n, k)). Examples → 5, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
