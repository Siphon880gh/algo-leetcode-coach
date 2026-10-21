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
            'message' => "Problem: You are given the root of a binary tree in which every leaf holds false or true and every other node is an operator: OR, AND or XOR with two children, or NOT with one child, encoded by numbers that the statement defines. A node evaluates by applying its operator to its children’s values. You are also given a desired result. In one operation you may flip a leaf. Return the minimum number of flips so the root evaluates to result. For instance, AND(OR(true, false), NOT(true)) with result true → 1; OR(false, false) with result false → 0. (Restated from memory; limits and examples may differ slightly.)\nOR’s cost to be true?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'min(a1 + b0, a0 + b1, a1 + b1)', 'next' => 's2'],
                ['label' => 'a1 + b1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. One true child is enough; OR(true, false) with result true → 1 instead of 0.\nStep back to when you required both true.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "XOR’s cost to be false?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'a0 + b0', 'next' => 'wrong_b'],
                ['label' => 'min(a0 + b0, a1 + b1)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Two true children also give false; XOR(true, true) with result false → 2 instead of 0.\nStep back to when you required both false.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "NOT node?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Swap the child’s pair', 'next' => 'success'],
                ['label' => 'Copy the child’s pair', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The first constructed case → 0 instead of 1.\nStep back to when you copied the pair.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Constructed cases → 1, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
