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
            'message' => "Problem: A hidden binary array is accessible through a reader giving its length and, for four distinct indices, a value describing how their elements split (as the statement specifies). Return an index of the majority value, or −1 on a tie, within the call limit. For instance, [0,0,1,0,1,1,1,1] → any index holding a 1. (Restated from memory; limits and examples may differ slightly.)\nWhy does one swap tell equality?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Changing one element changes the split unless it matches', 'next' => 's2'],
                ['label' => 'It never changes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Different values change the split.\nStep back to when you doubted it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Indices 1–3?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Skip them', 'next' => 'wrong_b'],
                ['label' => 'Use quadruples with index 4 to compare each with 0', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. They count toward the majority.\nStep back to when you skipped them.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Equal counts?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return −1', 'next' => 'success'],
                ['label' => 'Return 0', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A tie has no majority.\nStep back to when you returned 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n) queries.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
