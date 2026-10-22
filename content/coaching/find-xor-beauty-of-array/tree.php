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
            'message' => "Read the problem statement above.\nWhat remains after pairing (i, j, k) with (j, i, k)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only i = j, giving nums[i] & nums[k]', 'next' => 's2'],
                ['label' => 'Nothing; the answer is 0', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Triples with i = j have no partner; Example 1 → 0 instead of 5.\nStep back to when you cancelled everything.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Combine the remaining values with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'OR of all elements', 'next' => 'wrong_b'],
                ['label' => 'XOR of all elements', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. XOR is not OR; Example 2 → 63 instead of 34.\nStep back to when you used OR.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 5, 34.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
