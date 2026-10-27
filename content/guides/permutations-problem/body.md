## Tiny example

The permutations of `[1, 2, 3]` are all of its orderings.

One depth-first path:

1. Pick `1` first, so the path is `[1]`.
2. Pick `2` next, so the path is `[1, 2]`.
3. Only `3` is left, so the path is `[1, 2, 3]`. Record it.
4. Undo, and try the other unused numbers at each depth.

There are `3! = 6` permutations.

## How (with a used[] array or with swaps)

**With a used[] array:**

1. If the length of `path` equals n, record a copy.
2. For each index `i` that is not used: mark it used, push `nums[i]`, recurse, then pop and unmark it.

**With swaps:** swap `nums[depth]` with each candidate `i >= depth`, recurse on `depth+1`, then swap back.

## Trap

Pushing onto `path` but recording the **same list object** in the answer. Later undos empty every saved permutation.

**Fix:** Record `path[:]`, a fresh copy, at each leaf.

**Time:** O(n · n!) to build all permutations  
**Space:** O(n) for the path and the recursion (plus O(n · n!) to store the answers)

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
