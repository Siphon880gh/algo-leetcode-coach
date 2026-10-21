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
            'message' => "Read the problem statement above.\nCounts differ by 2?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return ""', 'next' => 's2'],
                ['label' => 'Interleave anyway', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Two of a kind would touch.\nStep back to when you interleaved.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which group first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Always letters', 'next' => 'wrong_b'],
                ['label' => 'The larger one', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. With more digits, letters first fails.\nStep back to when you fixed letters first.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Many valid outputs?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any is accepted', 'next' => 'success'],
                ['label' => 'Must sort', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Any valid reformat passes.\nStep back to when you sorted.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). \"a0b1c2\" → e.g. \"0a1b2c\". \"leetcode\" → \"\". \"1229857369\" → \"\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
