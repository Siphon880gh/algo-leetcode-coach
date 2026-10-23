## Tiny example

Permutations of `[1, 2, 3]` (all orderings).

One depth-first path:

1. Pick `1` first → path `[1]`
2. Pick `2` next → path `[1, 2]`
3. Only `3` left → path `[1, 2, 3]` (record)
4. Undo, try other unused numbers at each depth

There are `3! = 6` permutations.

## How (swap style or used[] style)

**used[] style:**

1. If `path` length == n, record a copy
2. For each index `i`, if not used, mark used, push `nums[i]`, recurse, pop, unmark

**Swap style:** swap `nums[depth]` with each candidate `i >= depth`, recurse `depth+1`, swap back.

## Trap

Pushing into `path` but recording the **same list reference** in the answer — later undos empty every saved permutation.

**Fix:** Record `path[:] ` / a fresh copy at each leaf.

**Time:** O(n · n!) to build all perms  
**Space:** O(n) for path / recursion (plus O(n · n!) to store answers)

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
