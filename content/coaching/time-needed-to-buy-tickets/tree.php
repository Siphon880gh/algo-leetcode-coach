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
            'message' => "Read the problem statement above.\nPeople in front of k?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'min(t[i], t[k]) tickets each', 'next' => 's2'],
                ['label' => 't[i] tickets each', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. They stop getting turns once k is done; Example 1 → 6, not 7.\nStep back to when you used t[i].",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "People behind k?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'min(t[i], t[k])', 'next' => 'wrong_b'],
                ['label' => 'min(t[i], t[k] − 1)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. In the last round k buys before them; [2,3,2] with k = 0 → 4, not 6.\nStep back to when you gave them t[k] turns.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Does going to the back of the line take time?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, only buying takes 1 second', 'next' => 'success'],
                ['label' => 'Yes, 1 second', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Moving to the end is instantaneous.\nStep back to when you charged for it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 6, 8.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
