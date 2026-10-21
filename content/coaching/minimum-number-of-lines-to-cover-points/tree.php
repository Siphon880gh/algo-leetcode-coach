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
            'message' => "Problem: Given an array points where points[i] = [xi, yi] are distinct points on a plane, return the minimum number of straight lines needed so that every point lies on at least one line. The number of points is small. For instance, [[0,1],[2,3],[4,5],[4,3]] → 2; [[0,2],[-2,-2],[1,4]] → 1; a single point → 1. (Restated from memory; limits and examples may differ slightly.)\nOne point left?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'It needs one more line', 'next' => 's2'],
                ['label' => 'It is free', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Every point must lie on a line; a single point → 1.\nStep back to when you treated it as free.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Collinear test?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Compare float slopes', 'next' => 'wrong_b'],
                ['label' => 'Integer cross product', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A vertical pair divides by zero, and floats can mismatch.\nStep back to when you computed slopes.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Line through p and q?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Also covers every uncovered point on it', 'next' => 'success'],
                ['label' => 'Covers only p and q', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. [[0,0],[1,1],[2,2]] → 1, but covering pairs only needs 2.\nStep back to when you covered just the pair.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(2^n · n²). Constructed cases → 2, 1, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
