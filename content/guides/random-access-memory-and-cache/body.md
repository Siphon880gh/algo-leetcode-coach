## Tiny example

Scan n ints.

**Array:** addresses `base, base+4, base+8, …` — CPU pulls whole **cache lines**; sequential scan streams fast.

**Linked list:** each `next` may jump to a distant address — more cache misses.

Same Big-O O(n), different wall clocks.


## How

1. Prefer contiguous layouts for heavy scans
2. Watch pointer-chasing structures in hot loops
3. Profile when constants matter


## Trap

Ignoring locality because “both are O(n)”.

**Fix:** Big-O equal ≠ same speed; cache misses cost real time.

**Practice tip:** arrays/vectors for tight loops when possible

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
