## Tiny example

Dedup backtracking when input has duplicates: `[1,1,2]` subsets.

Sort first. At the same depth, if `nums[i]==nums[i-1]` and `i-1` was not taken in this depth, **skip**.

That keeps one representative branch for identical choices.


## How

1. Sort
2. At depth, skip equal neighbors when the previous equal was not used
3. Still undo marks/path as usual


## Trap

Skipping duplicates without sorting — neighbors are not the equals you think.

**Fix:** Sort so equals sit together; then apply the skip rule.

**Time:** still exponential in worst case, but fewer dup leaves · **Space:** O(n)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Algo Learning IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
