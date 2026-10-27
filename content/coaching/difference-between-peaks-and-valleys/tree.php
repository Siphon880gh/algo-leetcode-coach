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
            'message' => "Read the problem statement above.\nCan index 0 be a peak?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes, if it is bigger than nums[1]', 'next' => 'wrong_a'],
                ['label' => 'No, it needs neighbours on both sides', 'next' => 's2'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. A peak needs 0 < i < n − 1. Counting the 6 at index 0 of Example 3 would add 6.\nStep back to when you used index 0.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Example 3: the 5 at index 3 sits between 2 and 5. Peak?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, it must beat both neighbours strictly', 'next' => 'success'],
                ['label' => 'Yes, it is not smaller than either', 'next' => 'wrong_b'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. With ≥, both 5s become peaks and the answer is 5 instead of −5.\nStep back to when you allowed ties.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. One pass with strict comparisons. O(n). Examples give 9, 12 and −5.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
