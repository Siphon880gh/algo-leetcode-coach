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
            'message' => "Read the problem statement above.\nCenter the search on?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The median', 'next' => 's2'],
                ['label' => 'The mean', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Absolute costs are smallest at the median; [6, 11, 60] → 65 instead of 54.\nStep back to when you used the mean.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Candidates?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Nearest palindrome below only', 'next' => 'wrong_b'],
                ['label' => 'Nearest palindrome below and above', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [40, 225] → 199 with 33 instead of 185 with 44.\nStep back to when you only looked below.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 6, 11, 22.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
