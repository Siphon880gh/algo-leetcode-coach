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
            'message' => "Read the problem statement above.\nBit i of the answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Opposite of nums[i][i]', 'next' => 's2'],
                ['label' => 'Same as nums[i][i]', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Copying the diagonal can rebuild a listed string; for [00, 01] it gives 01.\nStep back to when you copied the diagonal.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Why is the result missing from nums?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'It has more 1s than any string', 'next' => 'wrong_b'],
                ['label' => 'It differs from nums[i] at position i', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Counting 1s proves nothing; position i is the guaranteed difference.\nStep back to when you counted 1s.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Answer length?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'n, the same as every string', 'next' => 'success'],
                ['label' => 'n + 1', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The answer must have length n like the inputs.\nStep back to when you added a bit.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 11, 10 (or another valid string), 000.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
