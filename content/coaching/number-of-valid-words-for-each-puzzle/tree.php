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
            'message' => "Read the problem statement above.\nCheck every word against every puzzle?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: enumerate puzzle subsets', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is 10⁵ · 10⁴ checks.\nStep back to when you compared all pairs.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Subsets of which letters?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All seven', 'next' => 'wrong_b'],
                ['label' => 'The last six, with the first letter always added', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Every valid word must contain the first letter.\nStep back to when you let it go.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Word \"aaaa\". Its mask?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Just the bit for a', 'next' => 'success'],
                ['label' => 'Four bits', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A mask stores a set of letters.\nStep back to when you counted repeats.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(Σ word length + 64 · puzzles). [\"apple\",\"pleas\",\"please\"] → [0,1,3,2,0].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
