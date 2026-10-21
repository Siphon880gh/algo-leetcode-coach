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
            'message' => "Read the problem statement above.\nPick words greedily by score?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: try subsets', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A high-scoring word can block two that sum higher.\nStep back to when you went greedy.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Can a letter be reused?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes', 'next' => 'wrong_b'],
                ['label' => 'No: each letter once', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The letters form a fixed budget.\nStep back to when you reused letters.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "After exploring with a word?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Add its letters back', 'next' => 'success'],
                ['label' => 'Keep them subtracted', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Other branches need those letters.\nStep back to when you kept them subtracted.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(2ⁿ · 26). First example → 23. Second → 27. Third → 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
