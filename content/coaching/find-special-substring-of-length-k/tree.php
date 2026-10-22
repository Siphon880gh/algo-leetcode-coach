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
            'message' => "Read the problem statement above.\nRun length?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Exactly k', 'next' => 's2'],
                ['label' => 'At least k', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. aaaa, k = 3 → true instead of false.\nStep back to when you allowed longer.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Split how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Fixed blocks of k', 'next' => 'wrong_b'],
                ['label' => 'At each letter change', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. baaa, k = 3 → false instead of true.\nStep back to when you used blocks.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → true, false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
