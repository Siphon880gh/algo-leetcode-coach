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
            'message' => "Read the problem statement above.\nTry deleting each character and test for a palindrome?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: only the first mismatch matters', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(n²).\nStep back to when you tried every deletion.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "s[l] ≠ s[r]. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Skip the left character only', 'next' => 'wrong_b'],
                ['label' => 'Return isPal(l + 1, r) or isPal(l, r − 1)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. \"bcba\" needs the right skip.\nStep back to when you picked one side.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Inside isPal, is another skip allowed?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: the single deletion is used', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. At most one character may be deleted.\nStep back to when you allowed a second skip.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Two pointers with one branch: O(n). \"aba\" → true. \"abca\" → true. \"abc\" → false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
