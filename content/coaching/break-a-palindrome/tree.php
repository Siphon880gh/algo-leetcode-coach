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
            'message' => "Read the problem statement above.\nLength 1?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return ""', 'next' => 's2'],
                ['label' => 'Change it to a', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Any single character is a palindrome.\nStep back to when you changed it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Scan which part?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The whole string', 'next' => 'wrong_b'],
                ['label' => 'The left half, excluding the middle', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Changing the middle keeps the palindrome.\nStep back to when you included it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Left half all a?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Last character → b', 'next' => 'success'],
                ['label' => 'First character → b', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Changing the end keeps the string smallest.\nStep back to when you changed the front.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). \"abccba\" → \"aaccba\". \"a\" → \"\". \"aba\" → \"abb\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
