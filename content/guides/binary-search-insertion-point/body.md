## Tiny example

The sorted array is `a = [1, 3, 5, 7]`. You want to insert `4` and keep the array sorted.

The insertion point is the first index where `a[i] >= 4`. That is index `2`, just before `5`. This index is also called the lower bound.

After the insert the array would be `[1, 3, 4, 5, 7]`.

## How

1. Binary search for the first index `i` where `a[i] >= x`. For the upper bound, search for `a[i] > x` instead.
2. That index is the insertion point. It can be `n` when every element is smaller than `x`.
3. If you really change the array, shift the tail and write `x` at that index.

## Trap

Returning any index where `a[i] == x`. With duplicates, that may not be the leftmost one, and if `x` is missing there is no match at all.

**Fix:** Use the "first index where the test is true" template with the test `a[i] >= x`.

**Time:** O(log n) for the search, plus O(n) if you shift an array · **Space:** O(1) for the search

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
