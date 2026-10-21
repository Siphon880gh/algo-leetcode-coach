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
            'message' => "Read the problem statement above.\nDelete the rarest characters greedily?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: deletions can merge runs', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. In aabbaa, deleting bb merges a4.\nStep back to when you chose greedily.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Encoded length of a run of 1?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '2', 'next' => 'wrong_b'],
                ['label' => '1 (no digit)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A single character has no count.\nStep back to when you wrote 2.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Base case n − i ≤ k?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return 0: delete the rest', 'next' => 'success'],
                ['label' => 'Keep going', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Deleting everything left is allowed.\nStep back to when you continued.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n² k). \"aaabcccd\", 2 → 4. \"aabbaa\", 2 → 2. \"aaaaaaaaaaa\", 0 → 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
