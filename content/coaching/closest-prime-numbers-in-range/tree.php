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
            'message' => "Read the problem statement above.\nSieve start?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '0 and 1 are not prime', 'next' => 's2'],
                ['label' => 'Only 0 is not prime', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. 1 is not prime; left = 1, right = 3 → [1,2] instead of [2,3].\nStep back to when you kept 1.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Replace the best pair when the gap is?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Smaller or equal', 'next' => 'wrong_b'],
                ['label' => 'Strictly smaller', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Ties keep the smaller num1; Example 1 → [17,19] instead of [11,13].\nStep back to when you used ≤.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(right log log right). Examples → [11,13], [−1,−1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
