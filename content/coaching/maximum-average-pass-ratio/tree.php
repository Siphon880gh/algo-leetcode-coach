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
            'message' => "Read the problem statement above.\nHeap key?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Gain from one more student', 'next' => 's2'],
                ['label' => 'Current pass ratio', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A full class (2/2) has the top ratio but gains nothing.\nStep back to when you keyed by ratio.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Why greedy works?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'It does not', 'next' => 'wrong_b'],
                ['label' => 'Each class\'s gain shrinks as students are added', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Diminishing returns make the best next step always safe.\nStep back to when you doubted it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "After assigning?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Update p, t and push back', 'next' => 'success'],
                ['label' => 'Discard the class', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The class can still take more students.\nStep back to when you discarded it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O((n + extra) log n). Examples → 0.78333, 0.53485.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
