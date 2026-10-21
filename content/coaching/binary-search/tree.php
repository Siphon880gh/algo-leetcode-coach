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
            'message' => "Read the problem statement above.\nWith hi = n − 1, what is the loop condition?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'lo ≤ hi', 'next' => 's2'],
                ['label' => 'lo < hi', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. With a closed range, lo < hi skips checking the last single element.\nStep back to when you used lo < hi.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "nums[mid] < target. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'lo = mid', 'next' => 'wrong_b'],
                ['label' => 'lo = mid + 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. mid is already ruled out, and lo = mid can loop forever.\nStep back to when you kept mid.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How do you compute mid?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'lo + (hi − lo) // 2', 'next' => 'success'],
                ['label' => '(lo + hi) // 2 is always safe', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. In fixed-width integers, lo + hi can overflow.\nStep back to when you added lo and hi.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log n). [-1,0,3,5,9,12], target 9 → 4; target 2 → -1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
