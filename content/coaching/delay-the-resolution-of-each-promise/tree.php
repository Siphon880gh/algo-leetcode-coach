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
            'message' => "Problem: Given an array of functions that return promises and a delay in milliseconds, return new functions whose promises settle the same way as the originals, only that much later. Whether rejections are delayed too and the limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nReturn?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'An array of wrapper functions', 'next' => 's2'],
                ['label' => 'An array of promises', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Callers call each entry; in Node that throws a TypeError.\nStep back to when you returned promises.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Delay which outcomes?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only resolution', 'next' => 'wrong_b'],
                ['label' => 'Both', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Rejections slip through; in Node the rejecting check settles after about 10 ms instead of 60.\nStep back to when you delayed only then.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n) to build. The checks → 1, and rejected with e after about 60 ms.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
