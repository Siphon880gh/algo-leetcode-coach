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
            'message' => "Read the problem statement above.\nRight-side sum at i?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'total − left − nums[i]', 'next' => 's2'],
                ['label' => 'total − left', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. nums[i] itself belongs to neither side.\nStep back to when you kept it on the right.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Several middle indices?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return the rightmost', 'next' => 'wrong_b'],
                ['label' => 'Return the leftmost', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The task asks for the smallest index.\nStep back to when you kept scanning.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Negative values allowed. Two pointers from both ends?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, the prefix formula is enough', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. With negatives the running sums are not monotonic, so moving pointers by comparing sums can skip the answer.\nStep back to when you used two pointers.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 3, 2, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
