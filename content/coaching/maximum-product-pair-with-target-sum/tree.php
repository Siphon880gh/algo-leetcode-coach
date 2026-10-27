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
            'message' => "Read the problem statement above.\nExample 2: products −12 and −2. Which pair wins?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(4, −3), the bigger size', 'next' => 'wrong_a'],
                ['label' => '(2, −1), since −2 > −12', 'next' => 's2'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. −2 > −12. Comparing absolute values gives [2, 0] instead of [3, 1].\nStep back to when you dropped the sign.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "nums = [3, 3, 5], target = 6. Is (3, 3) valid?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes, 3 + 3 = 6', 'next' => 'wrong_b'],
                ['label' => 'No, nums[i] must be strictly greater', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The pair needs nums[i] > nums[j], so equal values never count. The answer is [−1, −1].\nStep back to when you allowed equal values.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. One pass with a value-to-index map. O(n). Examples give [2, 1], [3, 1] and [−1, −1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
