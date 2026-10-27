## Tiny example

Backtracking when the input has duplicates: the subsets of `[1,1,2]`.

Sort first. At the same depth, if `nums[i] == nums[i-1]` and `i-1` was not taken at this depth, **skip** `i`.

This keeps just one branch for each group of identical choices.

## How

1. Sort the input.
2. At each depth, skip an equal neighbor when the previous equal value was not used.
3. Undo the marks and the path as usual.

## Trap

Skipping duplicates without sorting. The neighbors are not the equal values you expect.

**Fix:** Sort so that equal values sit together, then apply the skip rule.

**Time:** still exponential in the worst case, but with fewer duplicate leaves · **Space:** O(n)

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
