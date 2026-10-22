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
            'message' => "Read the problem statement above.\nn ≤ 2?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return true', 'next' => 's2'],
                ['label' => 'Check the pair anyway', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Length-1 pieces are always good; [1, 1] with m = 5 → false instead of true.\nStep back to when you checked the pair.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Otherwise test?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The total sums to ≥ m', 'next' => 'wrong_b'],
                ['label' => 'Some adjacent pair sums to ≥ m', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The last piece of two must be big; example 2 → true instead of false.\nStep back to when you used the total.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → true, false, true.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
