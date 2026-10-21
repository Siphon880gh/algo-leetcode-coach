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
            'message' => "Read the problem statement above.\nClose pair in different cities. Mark which?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Both', 'next' => 's2'],
                ['label' => 'Only the later one', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Each is within 60 minutes of the other.\nStep back to when you marked one.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Time difference exactly 60?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Valid', 'next' => 'wrong_b'],
                ['label' => 'Invalid: the window is inclusive', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Within and including 60 minutes counts.\nStep back to when you excluded 60.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Same name, same city, 10 minutes apart?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Not invalid by that rule', 'next' => 'success'],
                ['label' => 'Invalid', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The rule needs a different city.\nStep back to when you ignored the city.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²) worst case. [\"alice,20,800,mtv\",\"alice,50,1200,mtv\"] → [\"alice,50,1200,mtv\"].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
