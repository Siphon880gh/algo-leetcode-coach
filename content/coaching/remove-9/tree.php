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
            'message' => "Problem: Problem: Starting from 1, remove every integer that contains the digit 9 (9, 19, 29, …, 90–99, …). Return the nth integer in the sequence that remains (1-indexed). (Restated from memory; limits and examples may differ slightly.)\nCount up, skipping numbers with a 9?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: n can be about 8 · 10⁸', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Walking hundreds of millions of numbers is too slow.\nStep back to when you counted up.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which digits can the remaining numbers use?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1–9', 'next' => 'wrong_b'],
                ['label' => '0–8, the digits of base 9', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. 0 is allowed (10, 20); only 9 is removed.\nStep back to when you used 1–9.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "So the nth remaining number is?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'n written in base 9, read back as a decimal number', 'next' => 'success'],
                ['label' => 'n − (number of 9s below n)', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The kept numbers in order are exactly the base-9 strings in order, so convert n directly.\nStep back to when you subtracted.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Repeatedly take n % 9 as the next digit: O(log n). n = 9 → 10. n = 10 → 11.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
