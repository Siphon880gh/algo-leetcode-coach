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
            'message' => "Read the problem statement above.\nIs a comparison sort required?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: counting sort by the custom order is O(n)', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A sort with a rank key works, but counting avoids the log factor.\nStep back to when you chose a comparison sort.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A letter of order appears twice in s. Output?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'One copy', 'next' => 'wrong_b'],
                ['label' => 'Both copies together at its position', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Every character of s must appear in the output.\nStep back to when you dropped a copy.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Letters of s missing from order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Append them at the end, in any order', 'next' => 'success'],
                ['label' => 'Drop them', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. They are still part of s.\nStep back to when you dropped them.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(|s| + |order|). order \"cba\", s \"abcd\" → \"cbad\" (or any placement of d).\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
