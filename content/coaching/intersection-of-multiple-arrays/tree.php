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
            'message' => "Read the problem statement above.\nKeep a value when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Its count equals len(nums)', 'next' => 's2'],
                ['label' => 'Its count is at least 2', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → [1,2,3,4,5] instead of [3,4].\nStep back to when you used at least 2.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Order of the answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Order in the first array', 'next' => 'wrong_b'],
                ['label' => 'Ascending', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. nums = [[4,3],[3,4]] → [4,3] instead of [3,4].\nStep back to when you kept the first array’s order.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Why is counting exact?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Values are distinct inside each array', 'next' => 'success'],
                ['label' => 'It is not; dedupe each array first', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The statement already makes each inner array distinct, so a value seen len(nums) times is in all of them.\nStep back to when you added deduplication.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(total + 1000). Examples → [3,4], [].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
