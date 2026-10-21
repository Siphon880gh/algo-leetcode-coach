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
            'message' => "Problem: Convert a decimal number given as a string to uppercase hexadecimal, replace 0 with O and 1 with I, and return it if it uses only A–F, I, and O; otherwise return \"ERROR\". For instance, \"257\" gives \"IOI\" and \"3\" gives \"ERROR\". (Restated from memory; limits and examples may differ slightly.)\nInteger type?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '64-bit or arbitrary precision', 'next' => 's2'],
                ['label' => '32-bit int', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The number can exceed 32 bits.\nStep back to when you used a 32-bit int.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Letter case?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Lowercase', 'next' => 'wrong_b'],
                ['label' => 'Uppercase', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The letters must be uppercase.\nStep back to when you used lowercase hex.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "A digit 2–9 remains?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return "ERROR"', 'next' => 'success'],
                ['label' => 'Drop it', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Any such digit makes the word invalid.\nStep back to when you dropped it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log num). \"257\" → \"IOI\". \"3\" → \"ERROR\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
