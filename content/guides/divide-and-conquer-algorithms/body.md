## Tiny example

Merge sort on `[3,1,4,2]`:

1. **Divide** into `[3,1]` and `[4,2]`
2. **Conquer** (sort each) → `[1,3]`, `[2,4]`
3. **Combine** (merge) → `[1,2,3,4]`

Subproblems are independent; combine does the real joining work.


## How

1. Split into smaller same-shaped pieces
2. Solve recursively (base: tiny input)
3. Merge answers with a clear combine step


## Trap

Assuming every recursive algorithm is divide-and-conquer even when subproblems heavily overlap (that leans DP).

**Fix:** If subproblems overlap a lot, add memo/DP; pure D&C expects independent pieces.

**Time:** often T(n)=2T(n/2)+O(n) → O(n log n) · **Space:** depends on combine

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
