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
            'message' => "Read the problem statement above.\nThe character is \"I\". Place what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The smallest unused value', 'next' => 's2'],
                ['label' => 'The largest unused value', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Everything left must be larger than this value.\nStep back to when you used the largest.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "The character is \"D\". Place what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The next value in order', 'next' => 'wrong_b'],
                ['label' => 'The largest unused value', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The next value must be smaller.\nStep back to when you placed the next value.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How many values does the result have?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'n + 1', 'next' => 'success'],
                ['label' => 'n', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The permutation is of 0 … n.\nStep back to when you stopped at n.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). \"IDID\" → [0,4,1,3,2]. \"III\" → [0,1,2,3]. \"DDI\" → [3,2,0,1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
