## Tiny example

Use backtracking to place the numbers `{1, 2}` into a path of length 2, without reusing a number.

The leaves of the decision tree are the permutations. Prune a branch as soon as the partial path repeats a number that is already used.

The search is correct because it explores every leaf that could be a valid answer. The only branches skipped are dead ends that cannot succeed.

## How

1. Define the list of choices at each depth.
2. Mark a resource as used when you take it, and unmark it afterward.
3. Prune as soon as a constraint fails.

## Trap

Pruning a branch without being sure it cannot be completed. You may drop valid answers.

**Fix:** Prune only when no extension of the partial path can succeed.

**Time:** O(size of the explored tree) · **Space:** O(depth)

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
