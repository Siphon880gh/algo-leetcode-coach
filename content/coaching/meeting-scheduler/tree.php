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
            'message' => "Problem: Given two people's free slots (each list without overlaps) and a duration, return the earliest [start, start + duration] that fits both, or []. For instance, [[10,50],[60,120]] and [[0,15],[60,70]] give [60,68] for duration 8 and [] for 12. (Restated from memory; limits and examples may differ slightly.)\nOverlap of [a1, a2] and [b1, b2]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '[max(a1, b1), min(a2, b2)]', 'next' => 's2'],
                ['label' => '[min(a1, b1), max(a2, b2)]', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is the union.\nStep back to when you took min and max the other way.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Too short. Advance which?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Both', 'next' => 'wrong_b'],
                ['label' => 'The slot that ends first', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The longer slot may still overlap the next one.\nStep back to when you advanced both.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Long enough. Return?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '[start, start + duration]', 'next' => 'success'],
                ['label' => 'The whole overlap', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The meeting is exactly duration long.\nStep back to when you returned the overlap.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n + m log m). Duration 8 → [60,68]. Duration 12 → [].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
