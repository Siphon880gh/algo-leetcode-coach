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
            'message' => "Read the problem statement above.\nDigit sum of an element?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All its digits', 'next' => 's2'],
                ['label' => 'Only its last digit', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Multi-digit elements lose digits; Example 1 → 10 instead of 9.\nStep back to when you used x mod 10 alone.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Return?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Digit sum − element sum', 'next' => 'wrong_b'],
                ['label' => 'Element sum − digit sum', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The result is an absolute difference; Example 1 → −9 instead of 9.\nStep back to when you reversed it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · digits). Examples → 9, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
