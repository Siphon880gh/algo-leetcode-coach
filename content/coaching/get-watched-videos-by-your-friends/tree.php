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
            'message' => "Read the problem statement above.\nWhose videos count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only people at exactly that distance', 'next' => 's2'],
                ['label' => 'Everyone within it', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Closer friends are excluded.\nStep back to when you included them.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Visited set includes?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Nobody at first', 'next' => 'wrong_b'],
                ['label' => 'The start id', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. You could come back to yourself.\nStep back to when you left it out.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Sort order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Frequency, then name', 'next' => 'success'],
                ['label' => 'Name only', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Frequency comes first.\nStep back to when you sorted by name.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(V + E + W log W). Level 1 → [\"B\",\"C\"]. Level 2 → [\"D\"].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
