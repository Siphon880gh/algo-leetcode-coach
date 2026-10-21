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
            'message' => "Read the problem statement above.\nOne word?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Put all spaces after it', 'next' => 's2'],
                ['label' => 'Divide by w − 1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That divides by zero.\nStep back to when you divided.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Leftover spaces?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Drop them', 'next' => 'wrong_b'],
                ['label' => 'Append s mod (w − 1) at the end', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Output length must equal input length.\nStep back to when you dropped them.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Split method?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Split on runs of spaces', 'next' => 'success'],
                ['label' => 'Split on single spaces', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That creates empty words.\nStep back to when you split singly.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). \"  this   is  a sentence \" → \"this   is   a   sentence\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
