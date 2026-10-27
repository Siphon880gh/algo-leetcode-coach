## Example first

nums = [2, 3, 5, 3, 2, 1].

1. [2, 3] is fine. Adding 5 breaks it, because 2 + 3 = 5. Drop 2: [3, 5].
2. Add 3: the window's only pair sum is 8 and its only difference is 2. 3 is neither, so [3, 5, 3] is fine. Length 3.
3. Add 2: 5 − 3 = 2, so 2 + 3 = 5 appears. Shrink from the left until it is gone.

The best length is 3.

## Idea

Once a triple a + b = c is inside a window, every longer window around it is bad too, so the left end only moves right. A new value x breaks the window in two ways:

1. x is the sum: x = a + b for two values already inside.
2. x is an addend: x = c − a, so x equals the difference of two values inside.

## Steps

1. Keep cntSum[v] and cntDiff[v] over all pairs in the window (values ≤ 500, so arrays of size 1001 and 501).
2. For each right end with value x: while cntSum[x] > 0 or cntDiff[x] > 0, remove nums[l] (subtract its sums and differences with the rest of the window) and move l right.
3. Add x: count its sums and differences with every element in the window.
4. Update the answer with r − l + 1.

Each pair is added once and removed once.

## Trap

Tracking only sums. Adding 2 next to 3 and 5 slips through, and Example 1 gives 5 instead of 3. Fix: also track differences.

Checked: the examples give 3 and 4, and the window matched checking every triple in every subarray on 300 random arrays.

Time: O(n²)  
Space: O(max value)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Leetcode Practice Coach IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
